@if($type === 'reservation-change')
    <table class="reservation-change__confirmation-details">
        <thead>
            <tr>
                <th>Shop</th>
                <th>Date</th>
                <th>Time</th>
                <th>Number</th>
                <th>Menu</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ mb_strimwidth($reservation->shop->name, 0, 40, "...") }}</td>
                <td id="table-reservation-date">{{ old('reservation_date') ?? $reservation->reservation_date }}</td>
                <td id="table-reservation-time">{{ old('reservation_time') ?? $reservation->reservation_time }}</td>
                <td id="table-reservation-number">{{ old('number_of_people') ?? $reservation->number_of_people }}</td>
                <td id="table-reservation-menu">{{ old('reservation_menu') ?? $reservation->menu->name }}</td>
                <td id="table-reservation-price">{{ formattedTotalAmount($reservation->total_amount) }}</td>
            </tr>
        </tbody>
    </table>
@elseif($type === 'detail')
    <table class="detail__confirmation-details">
        <thead>
            <tr>
                <th>Shop</th>
                <th>Date</th>
                <th>Time</th>
                <th>Number</th>
                <th>Menu</th>
                <th>Price</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ mb_strimwidth($shop->name, 0, 40, "...") }}</td>
                <td id="table-reservation-date">{{ old('reservation_date') ?? '未選択' }}</td>
                <td id="table-reservation-time">{{ old('reservation_time') ?? '未選択' }}</td>
                <td id="table-reservation-number">{{ old('number_of_people') ?? '未選択' }}</td>
                <td id="table-reservation-menu">{{ old('reservation_menu') ?? '未選択' }}</td>
                <td id="table-reservation-price">未選択</td>
                <td id="table-payment-method">{{ old('payment_method') ?? '未選択' }}</td>
            </tr>
        </tbody>
    </table>
@elseif($type === 'reservation-detail')
    <table class="reservation-detail__table">
        <thead>
            <tr class="reservation-detail__table-row">
                <th>User</th>
                <th>Date</th>
                <th>Time</th>
                <th>Number</th>
                <th>Menu</th>
                <th>Price</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            <tr class="reservation-detail__table-row">
                <td>{{ $reservation->user->name }}</td>
                <td>{{ $reservation->reservation_date }}</td>
                <td>{{ $reservation->reservation_time }}</td>
                <td>{{ $reservation->number_of_people }}</td>
                <td>{{ $reservation->menu->name }}</td>
                <td>{{ formattedTotalAmount($reservation->total_amount) }}</td>
                <td>{{ $reservation->payment_method }} {{ $reservation->payment_status === 'paid' ? '決済済み' : '未決済' }}</td>
            </tr>
        </tbody>
    </table>
@else
    <table class="mypage__reservation-details">
        <thead>
            <tr>
                <th>Shop</th>
                <th>Date</th>
                <th>Time</th>
                <th>Number</th>
                <th>Menu</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ mb_strimwidth($reservation->shop->name, 0, 20, "...") }}</td>
                <td>{{ $reservation->reservation_date }}</td>
                <td>{{ $reservation->reservation_time }}</td>
                <td>{{ $reservation->number_of_people }}</td>
                <td>{{ $reservation->menu->name }}</td>
                <td>{{ formattedTotalAmount($reservation->total_amount) }}</td>
            </tr>
        </tbody>
    </table>
@endif