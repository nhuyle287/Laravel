<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    const FEATURES = [
        'customer',

        'invoice-management', //access
        'receipt',
        'revenue',
        'expenditure',
        'service-management', //access
        'staff-management', //access
        'staff',
        'position',
        'department',
        'user-management', //access
        'permission',
        'role',
        'user',
        'medicine',
        'list-medicine-management',
        'medical-examination',
        'list-medicine'
    ];

    const PERMISSIONS = [
        'access',
        'view',
        'create',
        'update',
        'delete',
        'search',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();

        try {
            $permissions = self::PERMISSIONS;
            $features = self::FEATURES;
            foreach ($features as $feature) {
                foreach ($permissions as $permision) {
                    $permission = new Permission();
                    $permission->name = $feature.'-'.$permision;
                    $permission->feature = $feature;
                    $permission->permission_type = $permision;
                    $permission->save();
                    $string = strpos($feature, "management");
                    if ($string == true) {
                        break;
                    }
                }
            }
        }
        catch (Exception $exception) {

        }

    }
}
