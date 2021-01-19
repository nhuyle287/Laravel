<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['id', 'name'];
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $messages = [];
    public $rules = [
        'name' => 'required|unique:roles,name,NULL,id,deleted_at,NULL',
        'permission_id' => 'required',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->messages = [
            'name.required' => __('role.name').__('general.required'),
            'name.unique' => __('role.name').__('general.exist'),
            'permission_id.required' => __('role.permission').__('general.required'),
        ];
    }

    public function getAll($key, $paginate) {
        $roles = Role::where('name', 'like', '%'.$key.'%')->paginate($paginate);
        return $roles;
    }
}
