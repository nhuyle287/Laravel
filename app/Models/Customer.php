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
        'phone_number' => 'required|min:10|max:10|numeric',
        'email' => 'required|email|unique:customers',
    ];
    protected $table = 'customers';
    protected $fillable = ['id', 'name','phone_number','email', 'address','notes'];
    public function __construct()
    {
        parent::__construct();
        $this->message = [
            'name.required' => 'Vui lòng nhập tên khách hàng ',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'phone_number.min' => 'Số điện thoại sai định dạng',
            'phone_number.max' => 'Số điện thoại sai',
            'phone_number.numeric' => 'Số điện thoại phải là số',

        ];
    }

    public function getAll($key, $paginate) {
        $customers = Customer::where('customers.name', 'like', '%'.$key.'%')
            ->orwhere('customers.email', 'like', '%'.$key.'%')
            ->orwhere('customers.phone_number', 'like', '%'.$key.'%')
            ->select('customers.*')
            ->paginate($paginate);
        return $customers;
    }
}

