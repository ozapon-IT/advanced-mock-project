<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => '管理者',
            'email' => 'test@admin.com',
            'password' => Hash::make('testadmin'),
            'email_verified_at' => Carbon::now(),
            'role' => 3,
        ]);

        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => "店舗代表者{$i}",
                'email' => "test@daihyousha{$i}.com",
                'password' => Hash::make("daihyousha{$i}"),
                'email_verified_at' => Carbon::now(),
                'role' => 2,
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "一般ユーザー{$i}",
                'email' => "test@user{$i}.com",
                'password' => Hash::make("testuser{$i}"),
                'email_verified_at' => Carbon::now(),
                'role' => 1,
            ]);
        }
    }
}
