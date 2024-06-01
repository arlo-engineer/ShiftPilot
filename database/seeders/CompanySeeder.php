<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'はなまるコンビニ',
                'admin_id' => '1',
            ],
            [
                'name' => 'ガスト',
                'admin_id' => '2',
            ],
        ]);
    }
}
