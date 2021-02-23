<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Prescript_Medicine extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $message = [];
    public $rules = [

    ];
    protected $table = 'prescript_medicine';
    protected $fillable = ['id', 'medicine_id','prescription_id','amount_medicine','total_price'];
    public function __construct()
    {
        parent::__construct();
        $this->message = [

        ];
    }
//    public function getAll($key, $paginate) {
//        $examination=DB::table('prescriptions')
//           ->join('customers as c','c.id','=','prescriptions.customer_id')
//
//            ->where('c.name', 'like', '%'.$key.'%')
//            ->select('c.name','prescriptions.*')
//            ->paginate($paginate);
//        return $examination;
//    }


}

