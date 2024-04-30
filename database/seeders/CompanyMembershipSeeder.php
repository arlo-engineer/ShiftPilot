<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_memberships')->insert([
            [
                'company_id' => '1',
                'user_id' => '1',
                'skills' => '新米',
                'remarks' => '早番です。',
            ],
            [
                'company_id' => '1',
                'user_id' => '2',
                'skills' => '中堅',
                'remarks' => '遅番です。',
            ],
            [
                'company_id' => '2',
                'user_id' => '3',
                'skills' => '一人前',
                'remarks' => '遅番です。',
            ],
        ]);
    }
}
