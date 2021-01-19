<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PositionTableSeeder::class);
        $this->call(StaffsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);



    }
}
