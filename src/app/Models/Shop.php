<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_id',
        'genre_id',
        'name',
        'summary',
        'image_path',
    ];

    /**
     * レビューとのリレーションを定義
     *
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * お気に入りとのリレーションを定義
     *
     * @return HasMany
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * 予約とのリレーションを定義
     *
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * メニューとのリレーションを定義
     *
     * @return HasMany
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * ユーザー(店舗代表者)とのリレーションを定義
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 地域とのリレーションを定義
     *
     * @return BelongsTo
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * ジャンルとのリレーションを定義
     *
     * @return BelongsTo
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * 地域でフィルタリング
     *
     * @param Builder $query
     * @param string|null $area
     * @return Builder
     */
    public function scopeFilterByArea($query, $area): Builder
    {
        if (!empty($area) && $area !== 'All area') {
            $query->where('area_id', $area);
        }
        return $query;
    }

    /**
     * ジャンルでフィルタリング
     *
     * @param Builder $query
     * @param string|null $genre
     * @return Builder
     */
    public function scopeFilterByGenre($query, $genre): Builder
    {
        if (!empty($genre) && $genre !== 'All genre') {
            $query->where('genre_id', $genre);
        }
        return $query;
    }

    /**
     * キーワードでフィルタリング
     *
     * @param Builder $query
     * @param string|null $text
     * @return Builder
     */
    public function scopeFilterByText($query, $text): Builder
    {
        if (!empty($text)) {
            $query->where(function ($q) use ($text) {
                $q->where('name', 'like', '%' . $text . '%')
                    ->orwhereHas('area', function ($q2) use ($text) {
                        $q2->where('name', 'like', '%' . $text . '%');
                    })
                    ->orwhereHas('genre', function ($q3) use ($text) {
                        $q3->where('name', 'like', '%' . $text .'%');
                    });
            });
        }
        return $query;
    }
}
