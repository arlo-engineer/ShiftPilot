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
                'name' => '山田 太郎',
                'email' => 't-yamada@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '石川 結子',
                'email' => 'y-ishikawa@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '鈴木 紗英',
                'email' => 's-suzuki@test.com',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
