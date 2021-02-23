<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstantsModel extends Model
{

    const  STATUS_MEDICINE = [
        'Chờ khám' => 0,
        'Khám' => 1,
        'Hủy' => 2,
        'Đã khám'=>3,
    ];
}
