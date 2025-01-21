<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'name',
        'price',
    ];

    /**
     * 店舗とのリレーションを定義
     *
     * @return BelongsTo
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * 予約とのリレーションを定義
     *
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMane(Reservation::class);
    }
}

