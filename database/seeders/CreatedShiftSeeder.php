<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreatedShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('created_shifts')->insert([
            [
                'company_membership_id' => '1',
                'work_date' => '2024-06-01',
                'start_time' => '17:00',
                'end_time' => '22:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
