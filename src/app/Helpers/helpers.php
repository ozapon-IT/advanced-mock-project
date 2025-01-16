<?php

/**
 * 10:00 から 24:00 までの30分間隔の予約時間リストを生成。
 *
 * @return array<string> フォーマット済みの時間（例: "10:00", "10:30"）の配列。
 */
function generateReservationTimes(): array
{
    $times = [];

    for ($hour = 10; $hour <= 24; $hour++) {
        foreach ([0, 30] as $minute) {
            if ($hour === 24 && $minute === 30) {
                break;
            }

            $times[] = sprintf('%02d:%02d', $hour, $minute);
        }
    }

    return $times;
}

/**
 * 予約人数の選択肢を生成。
 *
 * @return array<string> フォーマット済みの人数（例: "1人", "2人", ... "40人"）の配列。
 */
function generateReservationNumbers(): array
{
    $numbers = [];

    for ($i = 1; $i <= 40; $i++) {
        $numbers[] = $i . '人';
    }

    return $numbers;
}