<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    const FEATURES = [
        'customer',
        'list-service-management', //access
        'register-domain',
        'register-hosting',
        'register-vps',
        'register-email',
        'register-ssl',
        'register-website',
        'register-soft',
        'order-management', //access
        'order-service',
        'order-software',
        'invoice-management', //access
        'receipt',
        'revenue',
        'expenditure',
        'service-management', //access
        'domain',
        'hosting',
        'vps',
        'email',
        'ssl',
        'website',
        'software-management', //access
        'software',
        'typesoftware',
        'staff-management', //access
        'staff',
        'position',
        'department',
        'internship-management', //access
        'internship',
        'internship-topic',
        'category-topic',
        'topic',
        'contract-management', //access
        'contract',
        'contract-software',
        'contract-vps',
        'contract-hosting',
        'contract-domain',
        'user-management', //access
        'permission',
        'role',
        'user',
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
