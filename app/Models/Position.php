<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'positions';
    protected $fillable = ['id', 'name', 'description', 'code'];

    public $messages = [];
    public $rules = [
        'name' => 'required|unique:positions,name,NULL,id,deleted_at,NULL',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->messages = [
            'name.required' => __('staff.position').__('general.required'),
            'name.unique' => __('staff.position').__('general.exist'),
        ];
    }

    public function createCode($name) {
        $string = explode(" ", $name);
        $code = '';
        foreach ($string as $item) {
            $code = $code.strtoupper(substr($item, 0, 1));
        }
        $codeCheck = $code.'001';
        while ($this->checkCodeExist($codeCheck) !== false) {
            $number = substr($this->checkCodeExist($codeCheck), -3, 3);
            $newNumber = $number + 1;
            if ($newNumber < 10) {
                $newNumber = '00'.$newNumber;
            }
            elseif ($newNumber < 100) {
                $newNumber = '0'.$newNumber;
            }
            $codeCheck = $code.''.$newNumber;
        }
        return $this->code = $codeCheck;
    }

    public function checkCodeExist($code) {
        $codes = Position::withTrashed()->where('code', '=', $code)->first();
        if ($codes !== null) {
            return $codes->code;
        }
        return false;
    }

    public function getAll($key, $paginate) {
        $positions = Position::where('name', 'like', '%'.$key.'%')->paginate($paginate);
        return $positions;
    }
}
