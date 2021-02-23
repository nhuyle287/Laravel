<?php


namespace App\Http\Controllers\Register;


use App\Models\Customer;
use App\Models\Register_Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Register_MedicineController extends RegisterController
{
    public function get_register()
    {
        $customer = Customer::all();
        return view('register.register_medicine',compact('customer'));
    }

    public function register(Request $request)
    {
//        dd($request->all());
        $customer=DB::table('customers')
            ->orWhere('phone_number','=',$request->phone_number)->first();
        if($customer==null)
        {
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
                return redirect(route('admin.customers.index'))->with('success', 'Thành công');
            } catch (\Exception $e) {
                return redirect(route('admin.customers.index'))->with('fail', 'Thất bại');

            }
        }
        else{
            $cus_id=$customer->id;
            $cus_medicine=new Register_Medicine();
            $cus_medicine->customer_id=$cus_id;
            $cus_medicine->status=0;
            try {

                $cus_medicine->save();
                return redirect(route('admin.customers.index'))->with('success', 'Thành công');
            } catch (\Exception $e) {
                return redirect(route('admin.customers.index'))->with('fail', 'Thất bại');

            }

        }
//        dd($customer);
    }
}
