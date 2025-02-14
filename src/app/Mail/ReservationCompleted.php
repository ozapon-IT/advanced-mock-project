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
    public $qrCodePath;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->reservationUrl = route('show.reservation-detail', $this->reservation->id);

        try {
            // QRコード生成
            $options = new QROptions([
                'version'      => 7,
                'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel'     => QRCode::ECC_M,
                'scale'        => 7,
            ]);

            $qrCode = new QRCode($options);
            $imageData = $qrCode->render($this->reservationUrl);

            \Log::info('[MAIL DEBUG]', [
                'reservation_id' => $this->reservation->id,
                'len' => strlen($imageData),
                'url' => $this->reservationUrl,
            ]);

            // 画像ファイルとして保存
            $fileName = 'qr_codes/qr_' . $this->reservation->id . '_' . Carbon::now()->timestamp . '.png';
            Storage::disk('public')->put($fileName, file_get_contents($imageData));

             // 保存したパス
            $this->qrCodePath = storage_path("app/public/{$fileName}");
        } catch (\Exception $e) {
            \Log::error('QRコード生成エラー: ' . $e->getMessage());
            \Log::error('スタックトレース: ' . $e->getTraceAsString());
            $this->qrCodePath = null;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '【予約完了】ご予約が確定しました',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation_completed',
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
        return $this->qrCodePath ? [
            Attachment::fromPath($this->qrCodePath)->as('qrcode.png')->withMime('image/png'),
        ] : [];
    }
}