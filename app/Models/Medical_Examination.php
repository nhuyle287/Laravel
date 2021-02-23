<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Medical_Examination extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $message = [];
    public $rules = [

    ];
    protected $table = 'medical_examinations';
    protected $fillable = ['id', 'customer_id','register_medicine_id','price',
        'circuit','temperature','breathing','blood_pressure','diagnostic','price_dif','total_price'];
    public function __construct()
    {
        parent::__construct();
        $this->message = [

        ];
    }
    public function getAll($key, $paginate) {
        $medical_examination=DB::table('medical_examinations')
           ->join('customers as c','c.id','=','medical_examinations.customer_id')

            ->where('c.name', 'like', '%'.$key.'%')
            ->select('c.name','medical_examinations.*')
            ->paginate($paginate);
        return $medical_examination;
    }


}

