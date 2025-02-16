<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ご予約のリマインド</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #edf2f6;
            margin: 0;
        }
        h1 {
            color: #333;
            font-size: 24px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .section {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- タイトル -->
        <h1>ご予約のリマインド</h1>

        <!-- 挨拶 -->
        <p>{{ $reservation->user->name }} 様<br>
        本日ご予約を頂いております。</p>

        <hr>

        <!-- 本文 -->
        <p>店舗名: {{ $reservation->shop->name }}</p>
        <p>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</p>
        <p>予約人数: {{ $reservation->number_of_people }}</p>
        <p>予約メニュー: {{ $reservation->menu->name }}</p>

        <hr>

        <!-- フッター -->
        <p>楽しみにお待ちしております。</p>
    </div>
</body>
</html>