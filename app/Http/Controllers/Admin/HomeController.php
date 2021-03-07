<?php

namespace App\Http\Controllers\Admin;


use App\Models\Customer;
use App\Models\Medical_Examination;
use Illuminate\Support\Facades\DB;

class HomeController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $customers=Customer::all();
        $customer_count=$customers->count();
        $medical_examination=DB::table('medical_examinations')->whereYear('created_at', '=', date('Y'))->count();

        $month = ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7',
            'Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'];

        $price = [];
        $month_=[1,2,3,4,5,6,7,8,9,10,11,12];
        $year=DB::table('medical_examinations')->select(DB::raw('Year(medical_examinations.date_examination) as year'))->distinct()->get();
        foreach ($month_ as $key => $value) {
            $price[] = Medical_Examination::whereMonth('medical_examinations.date_examination', '=', $value)->sum('medical_examinations.total_price');
        }

        $price_year=[];
        foreach ($year as $key => $value) {
            $price_year[] = Medical_Examination::whereYear('medical_examinations.date_examination', '=', $value->year)->sum('medical_examinations.total_price');
        }
//        dd($price);

        return view('home')->with('customer_count',$customer_count)->with('medical_examination',$medical_examination)
            ->with('month',json_encode($month,JSON_ERROR_UTF8))
            ->with('price',json_encode($price,JSON_NUMERIC_CHECK))
            ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
            ->with('price_year',json_encode($price_year,JSON_NUMERIC_CHECK));

    }
}
