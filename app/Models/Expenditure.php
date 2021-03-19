<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Expenditure extends Model
{
    //
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $message = [];
    public $rules = [];
    protected $table = 'expenditures';
    protected $fillable = ['id', 'receiver', 'address_receiver', 'price', 'description', 'date'];

    public function __construct()
    {
        parent::__construct();
        $this->message = [];
    }


    public function get_all($key, $paginate)
    {
        $expenditure = db::table('expenditures')
//            ->leftJoin('users as u','u.id','expenditures.id_staff')
//            ->leftJoin('staffs as s', 's.email', 'u.email')
            ->select('expenditures.*')
            ->whereNull('expenditures.deleted_at')
            ->where('expenditures.receiver', 'LIKE', '%' . $key . '%')
            ->orderBy('expenditures.id', 'ASC')
            ->paginate($paginate);
        return $expenditure;
    }

}
