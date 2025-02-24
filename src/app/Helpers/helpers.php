<?php

use App\Models\Menu;

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

/**
 * 指定された店舗の予約メニューリストを生成。
 *
 * @param int $shopId 店舗ID
 * @return array<string> 店舗のメニュー名（例: "Aコース", "Bコース", ...）の配列。
 */
function generateReservationMenus(int $shopId): array
{
    return Menu::where('shop_id', $shopId)->pluck('name')->toArray();
}

/**
 * 合計金額を計算 (decimal型の値を返却)。
 *
 * @param int $numberOfPeople 予約人数
 * @param string $menuName メニュー名
 * @param int $shopId 店舗ID
 * @return float 合計金額 (decimal型で保存可能)
 */
function calculateTotalAmount(int $numberOfPeople, string $menuName, int $shopId): float
{
    $menuPrice = Menu::where('shop_id', $shopId)
        ->where('name', $menuName)
        ->value('price');

    if (!$menuPrice) {
        return 0;
    }

    return $menuPrice * $numberOfPeople;
}

/**
 * フォーマット済みの合計金額を表示 (例: "¥10,000")。
 *
 * @param float $amount 合計金額 (decimal型)
 * @return string フォーマット済みの金額文字列
 */
function formattedTotalAmount(float $amount): string
{
    return '¥' . number_format($amount);
}