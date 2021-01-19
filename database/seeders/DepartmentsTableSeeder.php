<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->truncate();
        DB::table('departments')->insert([
            [
                'name' => 'Nhân Sự',
                'code' => 'NS001',
            ],
            [
                'name' => 'Kế Toán',
                'code' => 'KT001',
            ],
            [
                'name' => 'Kỹ Thuật',
                'code' => 'KT002',
            ],
        ]);
    }
}
