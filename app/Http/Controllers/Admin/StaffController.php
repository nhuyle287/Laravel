<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends AdminController
{
    //Index
    public function index(Request $request)
    {
        $this->authorize('staff-access');

        $key = isset($request->key) ? $request->key : '';
        $staff = new Staff();
        $staffs = $staff->getAll($key, 10);

        if (isset($request->amount)) {
            $staffs = $staff->getAll($key, $request->amount);
        }
        return view('admin.staff.index', compact('staffs'));
    }

    //Show row with key
    public function searchRow(Request $request)
    {
        $staff = new Staff();
        $staffs = $staff->getAll($request->key, 10);
        if ($request->amount !== null) {
            $staffs = $staff->getAll($request->key, $request->amount);
        }
        return view('admin.staff.search-row', compact('staffs'));
    }

    //Show create form
    public function createForm(Request $request)
    {
        $staff = Staff::find($request->id);
        $positions = Position::get();
        $departments = Department::get();
        return view('admin.staff.edit-add')
            ->with(compact('staff'))
            ->with(compact('positions'))
            ->with(compact('departments'));
    }

    //Save to db
    public function store(Request $request)
    {
        try {
            $staff = new Staff();
            $user = new User();
            if ($request->id) {
                //Create if user deleted
                $user = User::where('email', '=', $request->email)
                   ->first();

                if ($user == null) {
                    $user = new User();
                };
                $user->rules['email'] = 'required|unique:users,email,'.$user->id.',id,deleted_at,NULL';
                $staff = Staff::find($request->id);
                $staff->rules['name'] = 'required';
                $staff->rules['email'] = 'required|unique:staffs,email,' . $staff->id . ',id,deleted_at,NULL';
                $staff->rules['address'] = 'required';
                $staff->rules['phone_number'] = 'required';
                $staff->rules['birthday'] = 'required';
                $staff->rules['salary'] = 'required';
                $staff->rules['position_code'] = 'required';
                $staff->rules['start_time'] = 'required';

            }
            //Validation
            $validator = $this->validateInput($request->all(), $staff->rules, $staff->messages);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->address = $request->address;
            $staff->phone_number = $request->phone_number;
            $staff->birthday = $request->birthday;
            $staff->salary = $request->salary;
            $staff->position_code = $request->position_code;
            $staff->start_time = $request->start_time;
            $staff->department_code = $request->department_code;
            //Add user
            if (($request->password != null & $request->id != null) || $request->id == null) {
                //Add account with staff role
                $role = Role::where('name', '=', 'staff')->first();
                $role_id = isset($role) ? $role->id : null;
                //Validation user

                $validator = $this->validateInput(['name' => $request->name, 'email' => $request->email, 'password' => $request->password, 'role_id' => $role_id], $user->rules, $user->messages);
                if ($validator->fails()) {
                    return redirect()->back()->withInput()->withErrors($validator);
                }
                //Save user table
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->role_id = $role_id;
                $user->save();
            }
            $staff->save();
            return redirect(route('admin.staffs.index'))->with('success', __('general.create_success'));
        } catch (\Exception $exception) {
//            dd($exception);
            return redirect(route('admin.staffs.index'))->with('fail', __('general.create_fail'));
        }
    }

    //Delete 1 row
    public function destroy(Request $request)
    {
        try {
            $staff = Staff::find($request->id);
            User::where('email', '=', $staff->email)->delete();
            $staff->delete();
            return redirect()->back()->with('success', __('general.delete_success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

    //Delete row selected
    public function destroySelect(Request $request)
    {
        try {
            $allVals = explode(',', $request->allValsDelete[0]);
            foreach ($allVals as $item) {
                $staff = Staff::find($item);
                User::where('email', '=', $staff->email)->delete();
                $staff->delete();
            }
            return redirect()->back()->with('success', __('general.delete_success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

}
