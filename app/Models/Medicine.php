<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $message = [];
    public $rules = [
        'price' => 'required|numeric',
        'purchase_price' => 'required|numeric',
        'name' => 'required',
        'producer' => 'required',
    ];
    protected $table = 'medicines';
    protected $fillable = ['id', 'name','producer','price', 'purchase_price'];
    public function __construct()
    {
        parent::__construct();
        $this->message = [
            'producer.required' => 'Vui lòng nhập tên nhà sản xuất',
            'name.required' => 'Vui lòng nhập tên thuốc',
            'price.required' => 'Vui lòng nhập giá bán lẻ',
            'price.numeric' => 'Giá bán lẻ phải là số',
            'purchase_price.required' => 'Vui lòng nhập giá nhập',
            'purchase_price.numeric' => 'Giá nhập phải là số',
        ];
    }

    public function getAll($key, $paginate) {
        $medicine = Medicine::where('medicines.name', 'like', '%'.$key.'%')
            ->orwhere('medicines.producer', 'like', '%'.$key.'%')
            ->whereNull('medicines.deleted_at')
            ->select('medicines.*')
            ->paginate($paginate);
        return $medicine;
    }
}

