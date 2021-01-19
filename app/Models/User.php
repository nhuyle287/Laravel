<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $table = 'users';

    public $messages = [];
    public $rules = [
        'name' => 'required',
        'password' => 'required',
        'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
        'role_id' => 'required',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->messages = [
            'name.required' => __('user.name').__('general.required'),
            'password.required' => __('user.password').__('general.required'),
            'email.required' => __('user.email').__('general.required'),
            'email.unique' => __('user.email').__('general.exist'),
            'role_id.required' => __('user.role').__('general.required'),
        ];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','id_department', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasPermission(Permission $permission) {
        $roleId = $this->role_id;
        $permissionRole = PermissionRole::where('role_id', '=', $roleId)
            ->where('permission_id', '=', $permission->id)
            ->first();
        if (isset($permissionRole)) {
            return true;
        }
        return false;
    }

    public function getAll($key, $paginate) {
        $users = User::join('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.name', 'like', '%'.$key.'%')
            ->select('roles.name as role_name', 'users.*')
            ->paginate($paginate);
        return $users;
    }
}
