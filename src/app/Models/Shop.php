<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

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
            $query->where('name', 'like', '%' . $text . '%');
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
