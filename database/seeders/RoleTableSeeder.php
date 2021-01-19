<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            [
                'name' => 'admin',
            ],
            [
                'name' => 'staff',
            ],
            [
                'name' => 'editor',
            ],
            [
                'name' => 'viewer',
            ],
        ]);
    }
}
