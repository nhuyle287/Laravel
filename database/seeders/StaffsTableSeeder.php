<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staffs')->truncate();
        DB::table('staffs')->insert([
            [
                'name' => 'Trần Văn A',
                'email' => 'tva@gmail.com',
                'address' => '125, LA Street',
                'phone_number' => '012345678',
                'birthday' => '2020-09-19',
                'salary' => '12000000',
                'position_code' => 'NVKT001',
                'start_time' => '2020-09-18',
                'department_code' => 'KT002',
            ],
            [
                'name' => 'Trần Văn B',
                'email' => 'tvb@gmail.com',
                'address' => '126, LA Street',
                'phone_number' => '012345679',
                'birthday' => '2020-09-19',
                'salary' => '12000000',
                'position_code' => 'NVKD001',
                'start_time' => '2020-09-18',
                'department_code' => 'KT002',
            ],
            [
                'name' => 'Trần Văn C',
                'email' => 'tvc@gmail.com',
                'address' => '126, LA Street',
                'phone_number' => '012345677',
                'birthday' => '2020-09-19',
                'salary' => '12000000',
                'position_code' => 'NVKT002',
                'start_time' => '2020-09-18',
                'department_code' => 'KT002',
            ],
        ]);
    }
}
