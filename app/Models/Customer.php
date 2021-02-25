<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $message = [];
    public $rules = [
        'name' => 'required',
        'birthday' => 'required',
//        'phone_number' => 'required|min:10|max:10|unique:customers,phone_number,NULL,id,deleted_at,NULL',
//        'email' => 'required|email|unique:customers',
    ];
    protected $table = 'customers';
    protected $fillable = ['id', 'name','phone_number','birthday', 'address','notes'];
    public function __construct()
    {
        parent::__construct();
        $this->message = [
            'name.required' => 'Vui lòng nhập tên khách hàng ',
            'birthday.required' => 'Vui lòng nhập tuổi ',
//            'email.required' => 'Vui lòng nhập email',
//            'phone_number.unique' => 'Số điện thoại đã tồn tại',
//            'phone_number.required' => 'Vui lòng nhập số điện thoại',
//            'phone_number.min' => 'Số điện thoại sai',
//            'phone_number.max' => 'Số điện thoại sai',
//            'phone_number.phone' => 'Số điện thoại sai',


        ];
    }

    public function getAll($key, $paginate) {
        $customers = Customer::where('customers.name', 'like', '%'.$key.'%')
            ->orwhere('customers.code', 'like', '%'.$key.'%')
            ->orwhere('customers.phone_number', 'like', '%'.$key.'%')
            ->whereNull('customers.deleted_at')
            ->select('customers.*')
            ->paginate($paginate);
        return $customers;
    }
}

