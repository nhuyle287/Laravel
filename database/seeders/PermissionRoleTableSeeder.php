<?php

namespace Database\Seeders;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $permissons = Permission::get();
            foreach ($permissons as $permisson) {
                $permissonRole = new PermissionRole();
                $permissonRole->role_id = "1";
                $permissonRole->permission_id = $permisson->id;
                $permissonRole->save();
            }
        }
        catch (Exception $exception) {

        }
    }
}
