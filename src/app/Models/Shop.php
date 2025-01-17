<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area',
        'genre',
        'summary',
        'image_path',
    ];

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
     * 地域でフィルタリング
     *
     * @param Builder $query
     * @param string|null $area
     * @return Builder
     */
    public function scopeFilterByArea($query, $area): Builder
    {
        if (!empty($area) && $area !== 'All area') {
            $query->where('area', $area);
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
            $query->where('genre', $genre);
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
            $query->where(function ($query) use ($text) {
                $query->where('name', 'like', '%' . $text . '%')
                    ->orwhere('area', 'like', '%' . $text . '%')
                    ->orwhere('genre', 'like', '%' . $text . '%');
            });
        }
        return $query;
    }

    /**
     * 地域の選択肢を取得
     *
     * @return Collection
     */
    public static function getAreas(): Collection
    {
        return self::select('area')->distinct()->pluck('area');
    }

    /**
     * ジャンルの選択肢を取得
     *
     * @return Collection
     */
    public static function getGenres(): Collection
    {
        return self::select('genre')->distinct()->pluck('genre');
    }
}
