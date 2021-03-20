<?php


namespace App\Http\Controllers\Admin;




use App\Models\Expenditure;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ExpenditureController extends AdminController
{

    public function index(Request $request)
    {
        $this->authorize('customer-access');
        $key = isset($request->key) ? $request->key : '';
        $expenditure = new Expenditure();
        $expenditures = $expenditure->get_all($key, 10);

        if (isset($request->amount)) {
            $expenditures = $expenditure->get_all($key, $request->amount);
        }
        return view('admin.expenditure.index', compact('expenditures'));
    }

    public function searchRow(Request $request)
    {
        $expenditure = new Expenditure();
        $expenditures = $expenditure->get_all($request->key, 10);
        if ($request->amount !== null) {
            $expenditures = $expenditure->get_all($request->key, $request->amount);
        }
        return view('admin.expenditure.search-row', compact('expenditures'));
    }

    public function show(Request $request)
    {
        $expenditures = Expenditure::leftjoin('staffs as s', 's.id', '=', 'expenditures.id_staff')
            ->select('expenditures.*', 's.name', 's.address')
            ->whereNull('expenditures.deleted_at')
            ->whereNull('s.deleted_at')
            ->where('expenditures.id','=',$request->id)
            ->first();
        return view('admin.expenditure.show', compact('expenditures'));
    }

    public function print(Request $request)
    {

        $expenditures = Expenditure::leftjoin('staffs as s', 's.id', '=', 'expenditures.id_staff')
            ->select('expenditures.*', 's.name', 's.address')
            ->whereNull('expenditures.deleted_at')
            ->whereNull('s.deleted_at')
            ->where('expenditures.id', '=', $request->id)->first();
//        dd($register_services);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.expenditure.export', compact('expenditures'))
            ->setPaper('a5', 'landscape');
//        ->setPaper('a4','landscape');
        return $pdf->stream();

    }

    public function entry(Request $request)
    {
//        $customer = ($request->id) ? Customer::find($request->id) : new Customer();
//        return view('admin.customer.edit-add', compact('customer'));
        $staffs = Staff::all();
        if ($request->id) {
            $expenditures = db::table('expenditures as ex')
                ->where('ex.id', '=', $request->id)
                ->select('ex.*')->first();
        } else {
            $expenditures = new Expenditure();
        }
        return view('admin.expenditure.add-edit', compact('expenditures', 'staffs'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $expen = new Expenditure();


        $validator = $this->validateInput($request->all(), $expen->rules, $expen->message);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

//        $expen->id_staff = $request->id_staff;
        $expen->date = now()->format('Y/m/d H:i:s');
        $expen->price =(float) $request->price;
        $expen->receiver = $request->receiver;
        $expen->description = $request->description;
        $expen->address_receiver=$request->address_receiver;
//        $expen->id_staff=Auth::id();

        try {
            if ($request->id === null) {
                $expen->save();
            } else {
                $expen_update = Expenditure::find($request->id);
                if ($expen_update->id) {
                    $expen_update->update([ 'price' => $request->price,
                        'receiver' => $request->receiver, 'address_receiver'=>$request->address_receiver,'description' => $request->description]);
                }
            }

            return redirect(route('admin.expenditure.index'))->with('success', 'Thành công');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.expenditure.index'))->with('fail', 'Thất bại');

        }

    }

    public function destroy(Request $request)
    {
        try {
            $expenditure = Expenditure::find($request->id);

            if ($expenditure == null) {
                throw new \Exception();
            }
            $expenditure->delete();
            return redirect()->route('admin.expenditure.index')->with('success', 'Thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.expenditure.index')->with('fail', 'Lỗi');
        }
    }


    public function destroySelect(Request $request)
    {
        try {
            $allVals = explode(',', $request->allValsDelete[0]);
            if($allVals[0]!=="") {
                foreach ($allVals as $item) {
                    $expenditure = Expenditure::find($item);
                    $expenditure->delete();
                }
                return redirect()->back()->with('success', __('general.delete_success'));
            }
            else{
                return redirect()->back()->with('fail', 'Vui lòng chọn dòng cần xóa');
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }


}
