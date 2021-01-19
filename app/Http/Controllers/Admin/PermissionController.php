<?php


namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends AdminController
{
    //Index
    public function index(Request $request) {
        $this->authorize('permission-access');

        $key = isset($request->key) ? $request->key : '';
        $permission = new Permission();
        $permissions = $permission->getAll($key, 10);
        if (isset($request->amount)) {
            $permissions = $permission->getAll($key, $request->amount);
        }
        return view('admin.permission.index', compact('permissions'));
    }

    //Show row with key
    public function searchRow(Request $request) {
        $permission = new Permission();
        $permissions = $permission->getAll($request->key, 10);
        if ($request->amount !== null) {
            $permissions = $permission->getAll($request->key, $request->amount);
        }
        return view('admin.permission.search-row', compact('permissions'));
    }

    //Show create form
    public function createForm(Request $request) {
        $permission = Permission::find($request->id);
        return view('admin.permission.edit-add', compact('permission'));
    }

    //Save to db
    public function store(Request $request) {
        try {
            $permission = new Permission();
            if ($request->id)  {
                $permission = Permission::find($request->id);
                $permission->rules['name'] = 'required|unique:permissions,name,'.$permission->id.',id,deleted_at,NULL';
                $permission->rules['description'] = 'required';
            }
            //Validation
            $validator = $this->validateInput($request->all(), $permission->rules, $permission->messages);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            Permission::updateOrCreate(['id' => $request->id], $request->all());
            return redirect(route('admin.permissions.index'))->with('success', __('general.create_success'));
        } catch (\Exception $exception) {
            return redirect(route('admin.permissions.index'))->with('fail', __('general.create_fail'));
        }
    }

    //Delete one permission
    public function destroy(Request $request) {
        try {
            Permission::findOrFail($request->id)->delete();
            return redirect()->back()->with('success', __('general.delete_success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

    //Delete row selected
    public function destroySelect(Request $request) {
        try {
            $allVals = explode( ',', $request->allValsDelete[0]);
            foreach ($allVals as $item) {
                Permission::findOrFail($item)->delete();
            }
            return redirect()->back()->with('success', __('general.delete_success'));
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

}
