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
        //tạo mới đối tượng khi không có request( request trả về null)
        $cus = new Customer();

//        dd($auth);
//trong trường hợp chỉnh sửa (trả về id của đối tượng muốn chỉnh sửa)
        if ($request->id) {
            $cus = Customer::find($request->id);
            //để cho chỉnh sửa email
            //$cus->id; trỏ tới id để lấy thông tin chỉnh sửa
            //:customers,email -> customers là bảng, email là cột
            //'required|email|unique thay đổi luật trong trường hợp ngoại lệ

            $cus->rules['email'] = 'required|email|unique:customers,email,' . $cus->id;
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
        // chuyển đổi ngày tháng năm người dùng giống mysql trước khi đưa vào database
        //$request->birthday lấy name ngoài edit-add.blade.php

//        dd($request['birthday']);
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
