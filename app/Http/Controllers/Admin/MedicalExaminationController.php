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


    public function entry(Request $request)
    {

        $customer = $request->customer_id;
//        dd($customer);
        $medicine = Medicine::all();
        $register_medicine = ($request->id) ? Medical_Examination::find($request->id) : new Medical_Examination();
        return view('admin.register_medicine.edit', compact('customer', 'medicine', 'register_medicine'));
    }

    public function store(Request $request)
    {
        $register_medicine = new Register_Medicine;
        $medical_examination = new Medical_Examination();
        $prescription = new Prescription();
        $prescript_medicine = new Prescript_Medicine();
        dd($request->all());
//        medical_examination

        $date_medicine = now()->toDateString('Y-m-d');
        $medical_examination->date_examination = $date_medicine;
        $medical_examination->circuit = $request->circuit;
        $medical_examination->temperature = $request->temperature;
        $medical_examination->breathing = $request->breathing;
        $medical_examination->blood_pressure = $request->blood_pressure;
        $medical_examination->diagnostic = $request->diagnostic;
        $medical_examination->price_dif = 0;
        $medical_examination->total_price = 0;
        $medical_examination->save();

//        prescription

        $customer_id = $request->customer_id;
        $medical_examination_id = $medical_examination->id;
        $prescription->medicine_examination_id = $medical_examination_id;
        $prescription->customer_id = $customer_id;
        $prescription->save();

//        prescript_medicine
        $prescription_id = $prescription->id;
        $list_medicine = $request->list_datecc;
        if (is_array($list_medicine) || is_object($list_medicine))
            foreach ($list_medicine as $key => $value) {
                $list_medicine = explode(",", $value);
//                dd($list_medicine);

                $prescript_medicine->medicine_id = (int)$list_medicine[1];
                $prescript_medicine->prescription_id = $prescription_id;
                $prescript_medicine->amount_medicine = (int)$list_medicine[3];
                $prescript_medicine->total_price = (int)$list_medicine[5];
                $prescript_medicine->save();
                print_r($value);
            }
        try {
            $register_medicine->where('customer_id', $customer_id)->update(['medical_examination_id' => $medical_examination_id, 'status' => 3]);
            return redirect(route('admin.medical-examinations.index'))->with('success', 'Khám bệnh thành công');
        } catch (\Exception $e) {
            // echo($e);
//            return response()->json(['message' => 'Fail', 'status' => 0]);
            return redirect(route('admin.medical-examinations.index'))->with('fail', 'Khám bệnh thất bại');

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
            ->select('me.*', 'pre_me.amount_medicine', 'pre_me.total_price')
            ->get();
        return view('admin.history_examination.show', compact('register_medicines', 'medicines'));
    }
}
