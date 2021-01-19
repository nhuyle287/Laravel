<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->truncate();
        DB::table('positions')->insert([
            [
                'name' => 'Nhân Viên Kỹ Thuật',
                'code' => 'NVKT001',
            ],
            [
                'name' => 'Nhân Viên Kinh Doanh',
                'code' => 'NVKD001',
            ],
            [
                'name' => 'Nhân Viên Kế Toán',
                'code' => 'NVKT002',
            ],
        ]);
    }
}
