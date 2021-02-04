<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['id', 'name',  'feature', 'permission_type'];
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $messages = [];

    public $rules = [
        'name' => 'required|unique:permissions,name,NULL,id,deleted_at,NULL',

        'feature' => 'required',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->messages = [
            'name.required' => __('permission.name').__('general.required'),
            'name.unique' => __('permission.permission').__('general.exist'),
            'feature.required' => __('permission.screen').__('general.required'),
        ];
    }

    public function getAll($key, $paginate) {
        $permissions = Permission::where('name', 'like', '%'.$key.'%')->paginate($paginate);
        return $permissions;
    }
}
