<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>本日のご予約リスト</title>
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
        <h1>本日のご予約リスト</h1>

        <!-- 挨拶 -->
        <p>{{ $shop->user->name }} 様<br>
        店舗名: {{ $shop->name }}<br>
        本日ご予約を頂いております。</p>

        <!-- 本文 -->
        @foreach ($reservations as $reservation)
            <hr>
            <p>{{ $reservation->user->name }} 様</p>
            <p>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</p>
            <p>予約人数: {{ $reservation->number_of_people }}</p>
            <p>予約メニュー: {{ $reservation->menu->name }}</p>
        @endforeach

        <hr>

        <!-- フッター -->
        <p>ご確認をよろしくお願いいたします。</p>
    </div>
</body>
</html>