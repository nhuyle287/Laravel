<?php

namespace App\Http\Controllers\Admin;


use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends AdminController
{

    public function index(Request $request)
    {
        $this->authorize('medicine-access');

        $key = isset($request->key) ? $request->key : '';
        $medicine = new Medicine();
        $medicines = $medicine->getAll($key, 10);
        if (isset($request->amount)) {
            $medicines = $medicine->getAll($key, $request->amount);
        }

        return view('admin.medicine.index', compact('medicines'));
    }

    public function searchRow(Request $request)
    {
        $medicine = new Medicine();
        $medicines = $medicine->getAll($request->key, 10);
        if ($request->amount !== null) {
            $medicines = $medicine->getAll($request->key, $request->amount);
        }
//            dd($customers);
        return view('admin.medicine.search-row', compact('medicines'));
    }

    public function entry(Request $request)
    {

        $medicine = ($request->id) ? Medicine::find($request->id) : new Medicine();
        return view('admin.medicine.edit-add', compact('medicine'));
    }



    public function store(Request $request)
    {
        $medicine = new Medicine();
        $auth = Auth::id();
//        dd($auth);
//trong trường hợp chỉnh sửa (trả về id của đối tượng muốn chỉnh sửa)
        if ($request->id) {
            $medicine = Medicine::find($request->id);

        }
        //đánh giá xét duyệt có đúng với bên model không nếu fails thì trở về màn hình nhập + hiện thông báo lỗi
        $validator = $this->validateInput($request->all(), $medicine->rules, $medicine->message);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $medicine->fill($request->all());
        try {
            $medicine->save();
            return redirect(route('admin.medicines.index'))->with('success', 'Success');
        } catch (\Exception $e) {
            return redirect(route('admin.medicines.index'))->with('fail', 'Fail');

        }
    }


    public function destroy(Request $request)
    {
        try {
            $medicine = Medicine::find($request->id);

            if ($medicine == null) {
                throw new \Exception();
            }
            $medicine->delete();
            return redirect()->route('admin.medicines.index')->with('success', 'Thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.medicines.index')->with('fail', 'Lỗi');
        }
    }


    public function destroySelect(Request $request)
    {
        try {
            $allVals = explode(',', $request->allValsDelete[0]);
            if ($allVals[0] !== "") {
                foreach ($allVals as $item) {
                    $medicine = Medicine::find($item);
                    $medicine->delete();
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
