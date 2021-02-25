<?php


namespace App\Http\Controllers\Register;


use App\Models\Customer;
use App\Models\Register_Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Register_MedicalController extends RegisterController
{
    public function get_register()
    {
        return view('register.register_medicine');
    }
    public function get_register_code()
    {
        $customer = Customer::all();
        return view('register.register_medicine_code',compact('customer'));
    }

    public function register(Request $request)
    {
//        dd($request->all());
//        $customer=DB::table('customers')
//            ->orWhere('phone_number','=',$request->phone_number)->first();

            $cus=new Customer();
            $cus->name=$request->name;
            $cus->birthday=$request->birthday;
            $cus->phone_number=$request->phone_number;
            $cus->save();
            $cus_id=$cus->id;
            $cus_medicine=new Register_Medicine();
            $cus_medicine->customer_id=$cus_id;
            $cus_medicine->status=1;
            try {

                $cus_medicine->save();
                $cus_id=$cus->id;
                $code='KH'.$cus_id;
                $cus=new Customer();
                $cus->where('id',$cus_id)->update(['code'=>$code]);
                return redirect(route('admin.medical-examinations.index'))->with('success', 'Thành công');
            } catch (\Exception $e) {
                return redirect(route('admin.medical-examinations.index'))->with('fail', 'Thất bại');

            }

     //        dd($customer);
    }


    public function register_code(Request $request)
    {
//        dd($request->all());
//        $customer=DB::table('customers')
//            ->orWhere('phone_number','=',$request->phone_number)->first();


        $cus_medicine=new Register_Medicine();
        $cus_medicine->customer_id=$request->id_customer;
        $cus_medicine->status=1;
        try {
            $cus_medicine->save();
            return redirect(route('admin.medical-examinations.index'))->with('success', 'Thành công');
        } catch (\Exception $e) {
            return redirect(route('admin.medical-examinations.index'))->with('fail', 'Thất bại');

        }

        //        dd($customer);
    }
}
