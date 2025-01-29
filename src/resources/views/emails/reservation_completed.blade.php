<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約完了のお知らせ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        h1 {
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .section {
            margin-bottom: 20px;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- タイトル -->
        <h1>予約完了のお知らせ</h1>

        <!-- 挨拶 -->
        <p>{{ $reservation->user->name }}様<br>
        この度はご予約ありがとうございます。</p>

        <hr>

        <!-- 本文 -->
        <div class="section">
            <p>下記の内容で予約が確定しました：</p>
            <ul>
                <li><strong>店舗名:</strong> {{ $reservation->shop->name }}</li>
                <li><strong>予約日:</strong> {{ $reservation->reservation_date }}</li>
                <li><strong>予約時間:</strong> {{ $reservation->reservation_time }}</li>
                <li><strong>予約人数:</strong> {{ $reservation->number_of_people }}</li>
                <li><strong>予約メニュー:</strong> {{ $reservation->menu->name }}</li>
                <li><strong>合計金額:</strong> {{ formattedTotalAmount($reservation->total_amount) }}</li>
                <li><strong>支払い方法:</strong> {{ $reservation->payment_method }}
                    {{ $reservation->payment_status === 'paid' ? '決済済み' : '未決済' }}
                </li>
            </ul>
        </div>

        <hr>

        <!-- QRコード -->
        <div class="qr-code">
            @if ($reservationUrl)
                <p>ご来店時には添付されたQRコードを店舗スタッフにお見せください。</p>
            @endif
        </div>

        <hr>

        <!-- フッター -->
        <p>いつもご利用ありがとうございます。</p>
    </div>
</body>
</html>