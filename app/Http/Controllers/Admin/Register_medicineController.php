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

        return view('admin.register_medicine.index', compact('register_medicines', 'status'));
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
        return view('admin.register_medicine.search_row', compact('register_medicines', 'status'));
    }

    public function update(Request $request)
    {
        $register_medicine = new Register_Medicine();
//        dd($request->all());
        try {
            $register_medicine->where('id', $request->id)->update(['status' => (int)$request->status]);
            return redirect(route('admin.register-medicines.index'))->with('success', 'Thành công');
        } catch (\Exception $e) {
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

        return view('admin.register_medicine.indexMedical', compact('register_medicines', 'status'));
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
        return view('admin.register_medicine.search_rowMedical', compact('register_medicines', 'status'));
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
        $register_medicine =new Register_Medicine;
        $medical_examination = new Medical_Examination();
        $prescription = new Prescription();

//        dd($request->all());
//        medical_examination
        if($request->price_public=='TRUE')
        {
            $price_public=25000;
        }
        else {
            $price_public=0;
        }
        if($request->ECG=='TRUE')
        {
            $ECG=20000;
        }
        else {
            $ECG=0;

        }
        if($request->blood_sugar=='TRUE')
        {
            $blood_sugar=20000;
        }
        else {
            $blood_sugar=0;
        }
        $medical_examination->rules['circuit' ]='required';
        $medical_examination->rules['temperature' ]='required';
        $medical_examination->rules['breathing' ]='required';
        $medical_examination->rules['blood_pressure' ]='required';
        $medical_examination->rules['diagnostic' ]='required';
        $medical_examination->message['circuit.required'] = 'Vui lòng nhập mạch của khách hàng';
        $medical_examination->message['temperature.required'] = 'Vui lòng nhập nhiệt độ của khách hàng ';
        $medical_examination->message['breathing.required'] = 'Vui lòng nhập nhịp thở của khách hàng';
        $medical_examination->message['blood_pressure.required'] = 'Vui lòng nhập huyết áp của khách hàng ';
        $medical_examination->message['diagnostic.required'] = 'Vui lòng nhập chuẩn đoán bệnh';

        $medical_examination->circuit=$request->circuit;
        $medical_examination->temperature =(float) $request->temperature;
        $medical_examination->breathing=$request->breathing;
        $medical_examination->blood_pressure = $request->blood_pressure;
        $medical_examination->diagnostic=$request->diagnostic;
        $medical_examination->ECG = $ECG;
        $medical_examination->blood_sugar=$blood_sugar;
        $validator = $this->validateInput(['circuit'=>$request->circuit,'temperature'=> $request->temperature,
            'breathing'=>$request->breathing,'blood_pressure'=> $request->blood_pressure,
            'diagnostic'=>$request->diagnostic], $medical_examination->rules, $medical_examination->message);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $date_medicine = now()->toDateString('Y-m-d');
        $medical_examination->date_examination = $date_medicine;
        $medical_examination->total_price=$request->sum_totalprice;
        $medical_examination->price_public=$price_public;
        $medical_examination->save();

//        prescription

        $customer_id=$request->customer_id;
        $medical_examination_id=$medical_examination->id;
        $prescription->medicine_examination_id=$medical_examination_id;
        $prescription->customer_id=$customer_id;
        $prescription->save();

//        prescript_medicine
        $prescription_id=$prescription->id;
        $list_medicine=$request->list_datecc;
//        $list_totalprice=[];
//        dd($list_medicine);
        if (is_array($list_medicine) || is_object($list_medicine))
        {
            foreach ($list_medicine as $key => $value) {
                $list_medicine = explode(",", $value);
//                dd($list_medicine);
                $prescript_medicine = new Prescript_Medicine();
                $prescript_medicine->medicine_id = (int)$list_medicine[1];
                $prescript_medicine->prescription_id =$prescription_id;
                $prescript_medicine->amount_date = (float)$list_medicine[3];
                $prescript_medicine->morning = (float)$list_medicine[4];
                $prescript_medicine->afternoon = (float)$list_medicine[5];
                $prescript_medicine->everning = (float)$list_medicine[6];
                $prescript_medicine->night = (float)$list_medicine[7];
                $prescript_medicine->amount_medicine = (float)$list_medicine[8];
                $prescript_medicine->total_price = (float)$list_medicine[10];
//                array_push($list_totalprice, $total_price);

                $prescript_medicine->save();
//                print_r($prescript_medicine->id);
            }
        }


//        dd($sum);
        try {
                $register_medicine->where('customer_id',$customer_id)->where('status',1)->update(['medical_examination_id'=>$medical_examination_id,'status'=>3]);

            return redirect(route('admin.history-examinations.index'))->with('success', 'Khám bệnh thành công');
        } catch (\Exception $e) {
            // echo($e);
//            return response()->json(['message' => 'Fail', 'status' => 0]);
            return redirect(route('admin.history-examinations.index'))->with('fail', 'Khám bệnh thất bại');

        }
    }


    public function destroySelect(Request $request)
    {
        try {
            $allVals = explode(',', $request->allValsDelete[0]);

            if ($allVals[0] !== "") {
                foreach ($allVals as $item) {
                    $register_medicine = Register_Medicine::where('id',$item);
//                    dd($register_medicine);
                    $register_medicine->delete();
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
