<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicinee extends Model
{
    use HasFactory;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $messages = [];

    protected $table = 'medicines';
    protected $fillable = ['id', 'name', 'producer', 'price', 'purchase_price'];

    public function getAll($key, $paginate) {
        $medicine = Medicinee::where('name', 'like', '%'.$key.'%')->paginate($paginate);
        return $medicine;
    }


}
