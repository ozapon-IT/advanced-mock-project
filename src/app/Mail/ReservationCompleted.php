<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailables\Attachment;
use Carbon\Carbon;

class ReservationCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $reservationUrl;
    private $qrCodeData;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->reservationUrl = route('representative.reservations.show', $this->reservation->id);

        try {
            // QRコード生成
            $options = new QROptions([
                'version'      => 5, // 5〜10くらいの固定バージョンを試す
                'outputType'   => QRCode::OUTPUT_IMAGE_PNG, // PNG形式
                'eccLevel'     => QRCode::ECC_Q, // 高いエラー訂正（Hより低め）
                'scale'        => 10, // 拡大倍率（読み取りしやすいサイズ）
                'bgColor'      => [255, 255, 255], // 背景色（白）
                'fgColor'      => [0, 0, 0], // QRコードの色（黒）
                'margin'       => 8, // 余白を確保（静的ゾーン）
            ]);

            $qrCode = new QRCode($options);
            $imageData = $qrCode->render($this->reservationUrl);

            \Log::info('[MAIL DEBUG]', [
                'reservation_id' => $this->reservation->id,
                'len' => strlen($imageData),
                'url' => $this->reservationUrl,
            ]);

            $s3FileName = 'qr_codes/qr_' . $this->reservation->id . '_' . Carbon::now()->timestamp . '.png';
            $data = explode(',', $imageData)[1];
            Storage::disk('s3')->put($s3FileName, base64_decode($data));

            $this->qrCodeData = Storage::disk('s3')->get($s3FileName);

        } catch (\Exception $e) {
            \Log::error('QRコード生成エラー: ' . $e->getMessage());
            \Log::error('スタックトレース: ' . $e->getTraceAsString());
            $this->qrCodeData = null;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '【Rese】ご予約が確定しました',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation-completed',
            with: [
                'reservation' => $this->reservation,
                'reservationUrl' => $this->reservationUrl,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return $this->qrCodeData ? [
            Attachment::fromData(fn () => $this->qrCodeData)->as('qrcode.png')->withMime('image/png'),
        ] : [];
    }
}
