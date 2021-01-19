<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminController
{
    //Index
    public function index(Request $request) {
        $this->authorize('user-access');

        $key = isset($request->key) ? $request->key : '';
        $user = new User();
        $users = $user->getAll($key, 10);
        if (isset($request->amount)) {
            $users = $user->getAll($key, $request->amount);
        }

        return view('admin.user.index', compact('users'));
    }

    //Show row with key
    public function searchRow(Request $request) {
        $user = new User();
        $users = $user->getAll($request->key, 10);
        if ($request->amount !== null) {
            $users = $user->getAll($request->key, $request->amount);
        }
        return view('admin.user.search-row', compact('users'));
    }

    //Show create form
    public function createForm(Request $request) {
        $roles = Role::get();
        $user = User::find($request->id);
        return view('admin.user.edit-add', compact('roles'), compact('user'));
    }

    //Save to db
    public function store(Request $request)
    {
//        dd($request->all());
        try {
            $user = new User();
            //Validation (update form)
            if ($request->id)  {
                $user = User::find($request->id);
                $user->rules['name'] = 'required';
                $user->rules['email'] = 'required|unique:users,email,'.$user->id.',id,deleted_at,NULL';
                $user->rules['password'] = 'required';
            }
            //Validation
            $validator = $this->validateInput($request->all(), $user->rules, $user->messages);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            //Save user table
            $request['password']=Hash::make($request->password);
//            dd($request->all());
            User::updateOrCreate(['id' => $request->id], $request->all());
            return redirect(route('admin.users.index'))->with('success', __('general.create_success'));
        } catch (\Exception $e) {
            return redirect(route('admin.users.index'))->with('fail', __('general.create_fail'));
        }
    }

    //Delete one row
    public function destroy(Request $request)
    {
        try {
            User::findOrFail($request->id)->delete();
            return redirect()->back()->with('success', __('general.delete_success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

    //Delete row selected
    public function destroySelect(Request $request) {
        try {
            $allVals = explode(',', $request->allValsDelete[0]);
            foreach ($allVals as $item) {
                User::findOrFail($item)->delete();
            }
            return redirect()->back()->with('success', __('general.delete_success'));
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

}
