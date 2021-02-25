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
//        'circuit' => 'required',
//        'temperature'=>'required',
//        'breathing' => 'required',
//        'blood_pressure'=>'required',
//        'diagnostic' => 'required',

];
    protected $table = 'medical_examinations';
    protected $fillable = ['id', 'date_examination', 'price_public',
        'circuit', 'temperature', 'breathing', 'blood_pressure', 'diagnostic','total_price'];

    public function __construct()
    {
        parent::__construct();
        $this->message = [
//            'circuit.required' => 'Vui lòng nhập mạch của khách hàng ',
//            'temperature.required' => 'Vui lòng nhập nhiệt độ của khách hàng ',
//            'breathing.required' => 'Vui lòng nhập nhịp thở của khách hàng ',
//            'blood_pressure.required' => 'Vui lòng nhập huyết áp của khách hàng ',
//            'diagnostic.required' => 'Vui lòng nhập chuẩn đoán bệnh ',
//            'amount_date.required' => 'Vui lòng nhập số ngày ',
//            'morning.required' => 'Vui lòng nhập sl sáng ',
//            'afternoon.required' => 'Vui lòng nhập sl trưa ',
//            'everning.required' => 'Vui lòng nhập sl chiều ',
//            'night.required' => 'Vui lòng nhập sl tối ',
        ];
    }

    public function getAll($key, $paginate)
    {
        $medical_examination = DB::table('medical_examinations')
            ->join('customers as c', 'c.id', '=', 'medical_examinations.customer_id')
            ->where('c.name', 'like', '%' . $key . '%')
            ->whereNull('customers.deleted_at')
            ->whereNull('medical_examinations.deleted_at')
            ->select('c.name', 'medical_examinations.*')
            ->paginate($paginate);
        return $medical_examination;
    }


}

