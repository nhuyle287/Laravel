<?php

namespace App\Http\Controllers\Admin;


use App\Models\Customer;
use App\Models\Expenditure;
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
        $day=['Ngày 1','Ngày 2','Ngày 3','Ngày 4','Ngày 5','Ngày 6','Ngày 7','Ngày 8','Ngày 9','Ngày 10',
            'Ngày 11','Ngày 12','Ngày 13','Ngày 14','Ngày 15','Ngày 16','Ngày 17','Ngày 18','Ngày 19','Ngày 20',
            'Ngày 21','Ngày 22','Ngày 23','Ngày 24','Ngày 25','Ngày 26','Ngày 27','Ngày 28','Ngày 29','Ngày 30',
            'Ngày 31'
            ];
        $day_=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
        $price_day=[];
        foreach ($day_ as $key => $value) {
            $price_day[] = Medical_Examination::whereDay('medical_examinations.date_examination', '=', $value)->sum('medical_examinations.total_price');
        }
        $price_day_expenditure=[];
        foreach ($day_ as $key => $value) {
            $price_day_expenditure[] = Expenditure::whereDay('expenditures.date', '=', $value)->sum('expenditures.price');
        }
        $month = ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7',
            'Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'];

        $price = [];
        $month_=[1,2,3,4,5,6,7,8,9,10,11,12];
        $year=DB::table('medical_examinations')->select(DB::raw('Year(medical_examinations.date_examination) as year'))->distinct()->get();
        foreach ($month_ as $key => $value) {
            $price[] = Medical_Examination::whereMonth('medical_examinations.date_examination', '=', $value)->sum('medical_examinations.total_price');
        }

        $price_expenditure=[];
        foreach ($month_ as $key => $value) {
            $price_expenditure[] = Expenditure::whereMonth('expenditures.date', '=', $value)->sum('expenditures.price');
        }

        $price_year=[];
        foreach ($year as $key => $value) {
            $price_year[] = Medical_Examination::whereYear('medical_examinations.date_examination', '=', $value->year)->sum('medical_examinations.total_price');
        }

        $price_year_expenditure=[];
        foreach ($year as $key => $value) {
            $price_year_expenditure[] = Expenditure::whereYear('expenditures.date', '=',  $value->year)->sum('expenditures.price');
        }
//        dd($price);

        return view('home')->with('customer_count',$customer_count)->with('medical_examination',$medical_examination)
            ->with('month',json_encode($month,JSON_ERROR_UTF8))
            ->with('price',json_encode($price,JSON_NUMERIC_CHECK))
            ->with('day',json_encode($day,JSON_ERROR_UTF8))
            ->with('price_day',json_encode($price_day,JSON_NUMERIC_CHECK))
            ->with('price_day_expenditure',json_encode($price_day_expenditure,JSON_NUMERIC_CHECK))
            ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
            ->with('price_expenditure',json_encode($price_expenditure,JSON_NUMERIC_CHECK))
            ->with('price_year_expenditure',json_encode($price_year_expenditure,JSON_NUMERIC_CHECK))
            ->with('price_year',json_encode($price_year,JSON_NUMERIC_CHECK));

    }
}
