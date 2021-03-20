<?php


namespace App\Http\Controllers\Admin;

use App\Models\ConstantsModel;
use App\Models\Customer;
use App\Models\Medical_Examination;
use App\Models\Medicine;
use App\Models\Prescript_Medicine;
use App\Models\Prescription;
use App\Models\Register_Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MedicalExaminationController extends AdminController
{
    public function index(Request $request)
    {
        $this->authorize('list-medicine-access');
        $status = ConstantsModel::STATUS_MEDICINE;
        $key = isset($request->key) ? $request->key : '';
        $register_medicine = new Register_Medicine();
        $register_medicines = $register_medicine->getAllListHistory($key, 10);

        if (isset($request->amount)) {
            $register_medicines = $register_medicine->getAllListHistory($key, $request->amount);
        }

        return view('admin.history_examination.index', compact('register_medicines', 'status'));
    }

    public function searchRow(Request $request)
    {
        $status = ConstantsModel::STATUS_MEDICINE;
//dd($request->all());
        $register_medicine = new Register_Medicine();
        $register_medicines = $register_medicine->getAllListHistory($request->key, 10);
//        dd($register_medicines);
        if (isset($request->amount)) {
            $register_medicines = $register_medicine->getAllListHistory($request->key, $request->amount);
        }
//            dd($customers);
        return view('admin.history_examination.search_row', compact('register_medicines', 'status'));
    }


    public function update(Request $request)
    {

//dd($request->all());
        $history=Medical_Examination::find($request->id);
//        dd($history);
        try {
            $history->where('id',$request->id)->update(['diagnostic'=>$request->diagnostic]);

            return redirect(route('admin.history-examinations.index'))->with('success', 'Thành công');
        } catch (\Exception $e) {
            // echo($e);
//            return response()->json(['message' => 'Fail', 'status' => 0]);
            return redirect(route('admin.history-examinations.index'))->with('fail', 'Thất bại');

        }

    }

    public function show($id)
    {
//        dd($id);
        $register_medicines = db::table('medical_examinations as me_ex')
            ->join('register_medicines as re', 're.medical_examination_id', '=', 'me_ex.id')
            ->join('customers as cu', 'cu.id', '=', 're.customer_id')
            ->where('me_ex.id', '=', $id)
            ->select('me_ex.*','cu.name')
            ->first();
        $medicines = db::table('prescriptions as pre')
            ->join('prescript_medicine as pre_me', 'pre_me.prescription_id', '=', 'pre.id')
            ->join('medicines as me', 'me.id', '=', 'pre_me.medicine_id')
            ->where('pre.medicine_examination_id', '=', $id)
            ->select('me.*', 'pre_me.amount_medicine', 'pre_me.total_price','pre_me.amount_date',
            'pre_me.morning','pre_me.afternoon','pre_me.everning','pre_me.night')
            ->get();
        return view('admin.history_examination.show', compact('register_medicines', 'medicines'));
    }

    public function destroySelect(Request $request)
    {
        try {
            $allVals = explode(',', $request->allValsDelete[0]);
            if ($allVals[0] !== "") {
                foreach ($allVals as $item) {
                    $register_medicine=Register_Medicine::where('medical_examination_id',$item);
                    $register_medicine->delete();
                    $medical_excamination = Medical_Examination::find($item);
                    $medical_excamination->delete();
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
