<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeStaff extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $message = [];
    public $rules = [
        'name' => 'required|unique:typestaffs',

    ];
    protected $table = 'typestaffs';
    protected $fillable = ['id', 'name', 'description'];

    public function __construct()
    {
        parent::__construct();
        $this->message = [
            'name.required' => 'Vui lòng nhập tên phân loại nhân viên',
            'name.unique'=>'Tên loại không được trùng',

        ];
    }
}
