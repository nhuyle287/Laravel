<?php


namespace App\Http\Controllers\Admin;

use App\Models\ConstantsModel;
use App\Models\Customer;
use App\Models\Register_Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Register_medicineController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorize('list-medicine-access');
        $status = ConstantsModel::STATUS_MEDICINE;
        $key = isset($request->key) ? $request->key : '';
        $register_medicine = new Register_Medicine();
        $register_medicines = $register_medicine->getAll($key, 10);

        if (isset($request->amount)) {
            $register_medicines = $register_medicine->getAll($key, $request->amount);
        }

        return view('admin.register_medicine.index', compact('register_medicines','status'));
    }
    public function searchRow(Request $request)
    {
        $status = ConstantsModel::STATUS_MEDICINE;
//dd($request->all());
        $register_medicine = new Register_Medicine();
        $register_medicines = $register_medicine->getAll($request->key, 10);
//        dd($register_medicines);
        if (isset($request->amount)) {
            $register_medicines = $register_medicine->getAll($request->key, $request->amount);
        }
//            dd($customers);
        return view('admin.register_medicine.search_row', compact('register_medicines','status'));
    }
    public function update(Request $request)
    {
        $register_medicine = new Register_Medicine();
//        dd($request->all());
        try {
            $register_medicine->where('id',$request->id)->update(['status'=>(int)$request->status]);
            return redirect(route('admin.register-medicines.index'))->with('success', 'Thành công');
        }catch (\Exception $e)
        {
            return redirect(route('admin.register-medicines.index'))->with('fail', 'Thất bại');
        }
    }

//    list-medicine (đang khám)

    public function indexlist(Request $request)
    {
        $this->authorize('list-medicine-access');
        $status = ConstantsModel::STATUS_MEDICINE;
        $key = isset($request->key) ? $request->key : '';
        $register_medicine = new Register_Medicine();
        $register_medicines = $register_medicine->getAllList($key, 10);

        if (isset($request->amount)) {
            $register_medicines = $register_medicine->getAllList($key, $request->amount);
        }

        return view('admin.register_medicine.indexMedical', compact('register_medicines','status'));
    }

    public function searchRowlist(Request $request)
    {
        $status = ConstantsModel::STATUS_MEDICINE;
//dd($request->all());
        $register_medicine = new Register_Medicine();
        $register_medicines = $register_medicine->getAllList($request->key, 10);
//        dd($register_medicines);
        if (isset($request->amount)) {
            $register_medicines = $register_medicine->getAllList($request->key, $request->amount);
        }
//            dd($customers);
        return view('admin.register_medicine.search_rowMedical', compact('register_medicines','status'));
    }

    public function entry(Request $request)
    {
        $customer=Customer::all();
        return view('admin.register_medicine.edit', compact('customer'));
    }


}
