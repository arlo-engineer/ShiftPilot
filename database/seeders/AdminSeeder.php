<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => '田中 花子',
                'email' => 'h-tanaka@test.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '佐藤 一郎',
                'email' => 'i-sato@test.com',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
