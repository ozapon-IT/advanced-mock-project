<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

     // ユーザーのロールを定義
    const ROLE_USER = 1; // 一般ユーザー
    const ROLE_REPRESENTATIVE = 2; // 店舗代表者
    const ROLE_ADMIN = 3; // 管理者

    // ロールIDとロール名のマッピング
    public static array $roles = [
        self::ROLE_USER => 'User',
        self::ROLE_REPRESENTATIVE => 'Representative',
        self::ROLE_ADMIN => 'Admin',
    ];

    /**
     * 一般利用者かどうかを判定するメソッド
     *
     * @return bool 一般利用者であれば true、そうでなければ false
     */
    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    /**
     * 店舗代表者かどうかを判定するメソッド
     *
     * @return bool 店舗代表者であれば true、そうでなければ false
     */
    public function isRepresentative(): bool
    {
        return $this->role === self::ROLE_REPRESENTATIVE;
    }

    /**
     * 管理者かどうかを判定するメソッド
     *
     * @return bool 管理者であれば true、そうでなければ false
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * 現在のロール名を取得するメソッド
     *
     * @return string 現在のロール名（例: 'User', 'Representative', 'Admin'）
     */
    public function getRoleName(): string
    {
        return self::$roles[$this->role]  ?? 'Unknown';
    }

    /**
     * 店舗とのリレーションを定義(店舗代表者)
     *
     * @return HasOne
     */
    public function shop(): HasOne
    {
        return $this->hasOne(Shop::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
