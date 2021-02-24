<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Register_Medicine extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $message = [];
    public $rules = [

    ];
    protected $table = 'register_medicines';
    protected $fillable = ['id', 'customer_id'];
    public function __construct()
    {
        parent::__construct();
        $this->message = [

        ];
    }
    public function getAll($key, $paginate) {
       $register_medicine=DB::table('register_medicines')
           ->join('customers as c','c.id','=','register_medicines.customer_id')
           ->Where('register_medicines.status','=',0)
           ->orWhere('register_medicines.status','=',2)
            ->where('c.name', 'like', '%'.$key.'%')
            ->select('c.name','register_medicines.id','register_medicines.status')
            ->paginate($paginate);
        return $register_medicine;
    }

    public function getAllList($key, $paginate) {
        $register_medicine=DB::table('register_medicines')
            ->join('customers as c','c.id','=','register_medicines.customer_id')
            ->Where('register_medicines.status','=',1)
            ->Where('c.name', 'like', '%'.$key.'%')
            ->select('c.name','c.id as customer_id','register_medicines.id','register_medicines.status')
            ->paginate($paginate);
        return $register_medicine;
    }
    public function getAllListHistory($key, $paginate) {
        $register_medicine=DB::table('register_medicines')
            ->join('customers as c','c.id','=','register_medicines.customer_id')
            ->join('medical_examinations as me_ex','me_ex.id','=','register_medicines.medical_examination_id')
//            ->leftJoin('prescriptions as pre','pre.medicine_examination_id','=','me_ex.id')
//            ->leftJoin('prescript_medicine as pre_me','pre_me.prescription_id','=','pre.id')
            ->Where('register_medicines.status','=',3)
            ->Where('c.name', 'like', '%'.$key.'%')
//            ->Where('me_ex.date_examination', 'like', '%'.$key.'%')
            ->whereNull('register_medicines.deleted_at')
            ->select('c.name','c.address','c.phone_number','c.birthday','register_medicines.id as register_id','register_medicines.status','me_ex.*')
            ->paginate($paginate);
        return $register_medicine;
    }
}

