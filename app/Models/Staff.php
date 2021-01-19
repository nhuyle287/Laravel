<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Staff extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'staffs';
    protected $fillable = ['id', 'name', 'email', 'address', 'phone_number', 'birthday', 'salary', 'position_code', 'start_time', 'department_code'];

    public $messages = [];
    public $rules = [
        'name' => 'required',
        'email' => 'required|unique:staffs,email,NULL,id,deleted_at,NULL',
        'address' => 'required',
        'phone_number' => 'required',
        'birthday' => 'required',
        'salary' => 'required',
        'position_code' => 'required',
        'start_time' => 'required',
        'password' => 'required',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->messages = [
            'name.required' => __('staff.name').__('general.required'),
            'email.required' => __('staff.email').__('general.required'),
            'email.unique' => __('staff.email').__('general.exist'),
            'address.required' => __('staff.address').__('general.required'),
            'phone_number.required' => __('staff.phone_number').__('general.required'),
            'birthday.required' => __('staff.birthday').__('general.required'),
            'salary.required' => __('staff.salary').__('general.required'),
            'position_code.required' => __('staff.position').__('general.required'),
            'start_time.required' => __('staff.start_time').__('general.required'),
            'password.required' => __('staff.password').__('general.required'),
        ];
    }

    public function getAll($key, $paginate) {
        $staffs = Staff::join('positions', 'positions.code', '=', 'staffs.position_code')
            ->join('departments', 'departments.code', '=', 'staffs.department_code')
            ->where('staffs.name', 'like', '%'.$key.'%')
            ->select('staffs.*', 'positions.name as position_name', 'departments.name as department_name')
            ->paginate($paginate);
        return $staffs;
    }

}
