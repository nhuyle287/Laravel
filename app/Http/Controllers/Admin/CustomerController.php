<?php


namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorize('customer-access');

        $key = isset($request->key) ? $request->key : '';
        $customer = new Customer();
        $customers = $customer->getAll($key, 10);

        if (isset($request->amount)) {
            $customers = $customer->getAll($key, $request->amount);
        }

        return view('admin.customer.index', compact('customers'));


    }

    public function searchRow(Request $request)
    {
        $customer = new Customer();
        $customers = $customer->getAll($request->key, 10);
        if ($request->amount !== null) {
            $customers = $customer->getAll($request->key, $request->amount);
        }
//            dd($customers);
        return view('admin.customer.search-row', compact('customers'));
    }

    public function entry(Request $request)
    {

        $customer = ($request->id) ? Customer::find($request->id) : new Customer();
//        dd($customer);
        return view('admin.customer.edit-add', compact('customer'));
    }

    public function show(Request $request)
    {
        $customer = Customer::find($request->id);
        return view('admin.customer.show', compact('customer'));
    }

    //nút save
    public function store(Request $request)
    {
        $cus = new Customer();
        if ($request->id) {
            $cus = Customer::find($request->id);
            $cus_id=$cus->id;
            $cus->where('id',$cus_id)->update(['code'=>'KH'.$cus_id]);
            $cus->rules['phone_number'] = 'required|min:10|max:10|unique:customers,phone_number,' . $cus->id.',id,deleted_at,NULL';
        }
        //đánh giá xét duyệt có đúng với bên model không nếu fails thì trở về màn hình nhập + hiện thông báo lỗi
        $validator = $this->validateInput($request->all(), $cus->rules, $cus->message);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
       $cus->name = $request->name;
        $cus->phone_number = $request->phone_number;
        $cus->email = $request->email;
        $cus->address = $request->address;
        $cus->birthday = $request->birthday;
        $cus->notes = $request->notes;

        $cus->fill($request->all());
        try {

            $cus->save();
            return redirect(route('admin.customers.index'))->with('success', 'Success');
        } catch (\Exception $e) {
            return redirect(route('admin.customers.index'))->with('fail', 'Fail');

        }
    }

    public function destroy(Request $request)
    {
        try {
            $customer = Customer::find($request->id);

            if ($customer == null) {
                throw new \Exception();
            }
            $customer->delete();
            return redirect()->route('admin.customers.index')->with('success', 'Thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.customers.index')->with('fail', 'Lỗi');
        }
    }

    public function destroySelect(Request $request)
    {
        try {
            $allVals = explode(',', $request->allValsDelete[0]);
            if ($allVals[0] !== "") {
                foreach ($allVals as $item) {
                    $cus = Customer::find($item);
                    $cus->delete();
                }
                return redirect()->back()->with('success', __('general.delete_success'));
            } else {
                return redirect()->back()->with('fail', 'Vui lòng chọn dòng cần xóa');
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }
}
