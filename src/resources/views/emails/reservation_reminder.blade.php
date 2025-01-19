<p>{{ $reservation->user->name }} 様</p>
<p>本日ご予約を頂いております。</p>
<p>店舗名: {{ $reservation->shop->name }}</p>
<p>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</p>
<p>予約人数: {{ $reservation->number_of_people }}</p>
<p>楽しみにお待ちしております。</p>