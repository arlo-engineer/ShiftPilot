<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => '鈴木 紗英',
                'email' => 's-suzuki@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '田中 太郎',
                'email' => 't-tanaka@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '佐藤 花子',
                'email' => 'h-sato@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '山田 陽介',
                'email' => 'y-yamada@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '小林 美咲',
                'email' => 'm-kobayashi@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '加藤 大輔',
                'email' => 'd-kato@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '高橋 優子',
                'email' => 'y-takahashi@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '伊藤 翔太',
                'email' => 's-ito@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '渡辺 さくら',
                'email' => 's-watanabe@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '松本 裕樹',
                'email' => 'h-matsumoto@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '中村 愛',
                'email' => 'a-nakamura@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '斎藤 健',
                'email' => 'k-saito@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '林 佳奈',
                'email' => 'k-hayashi@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '池田 涼',
                'email' => 'r-ikeda@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '橋本 由美',
                'email' => 'y-hashimoto@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '青木 誠',
                'email' => 'm-aoki@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '山本 優花',
                'email' => 'y-yamamoto@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '森 拓也',
                'email' => 't-mori@test.com',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
