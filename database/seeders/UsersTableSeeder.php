<?php


namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array
        (array(
            'name' => 'admin',
            'email' =>'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => '1'
        )
        ));
    }
}
