<div class="mypage__reservation-card">
    <div class="mypage__reservation-card-header">
        <i class="bi bi-clock-fill"></i>

        <p>{{ $index === 0 ? '予約1' : '予約' . ($index + 1) }}</p>
    </div>

    <x-reservation-details-table :reservation="$reservation" />

    <div class="mypage__reservation-delete">
        <form action="{{ route('reservations.destroy', $reservation) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="mypage__button" type="submit">
                <i class="bi bi-x-circle"></i>
            </button>
        </form>
    </div>

    <div class="mypage__reservation-change">
        <form action="{{ route('reservations.edit', $reservation) }}" method="GET">
            <button class="mypage__button mypage__button--update" type="submit">予約変更</button>
        </form>
    </div>
</div>