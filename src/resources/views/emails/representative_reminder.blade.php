<p>{{ $shop->user->name }} 様</p>
<p>本日ご予約を頂いております。</p>
<p>店舗名: {{ $shop->name }}</p>

@foreach ($reservations as $reservation)
    <hr>
    <p>{{ $reservation->user->name }} 様</p>
    <p>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</p>
    <p>予約人数: {{ $reservation->number_of_people }}</p>
    <p>予約メニュー: {{ $reservation->menu->name }}</p>
@endforeach
<hr>
<p>ご確認をよろしくお願いいたします。</p>