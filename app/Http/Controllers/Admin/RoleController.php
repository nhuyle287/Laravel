<?php


namespace App\Http\Controllers\Admin;

use App\Business\PermissionLogic;
use App\Business\RoleLogic;
use App\Models\Customer;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class RoleController extends AdminController
{
    //Index
    public function index(Request $request) {
        $this->authorize('role-access');

        $key = isset($request->key) ? $request->key : '';
        $role = new Role();
        $roles = $role->getAll($key, 10);
        if (isset($request->amount)) {
            $roles = $role->getAll($key, $request->amount);
        }
        return view('admin.role.index', compact('roles'));
    }

    //Show row with key
    public function searchRow(Request $request) {
        $role = new Role();
        $roles = $role->getAll($request->key, 10);
        if ($request->amount !== null) {
            $roles = $role->getAll($request->key, $request->amount);
        }
        return view('admin.role.search-row', compact('roles'));
    }

    //Show create form
    public function createForm(Request $request) {
        $role = Role::find($request->id);
        $features = Permission::select('feature')->distinct()->get();
        $permissionRole = PermissionRole::where('role_id', '=', $request->id)->get();
        $arrayPermission = array();
        foreach ($permissionRole as $item) {
            array_push($arrayPermission, $item->permission_id);
        }
        return view('admin.role.edit-add', compact('role'))
            ->with(compact('features'))
            ->with(compact('arrayPermission'));
    }

    //Save to db
    public function store(Request $request) {
        try {
            $role = new Role();
            //Validation (update form)
            if ($request->id)  {
                $role = Role::find($request->id);
                $role->rules['name'] = 'required|unique:roles,name,'.$role->id.',id,deleted_at,NULL';
                $role->rules['permission_id'] = 'required';
                //Delete old permission
                $oldPermissions = PermissionRole::where('role_id', '=', $request->id)->get();
                if (isset($oldPermissions)) {
                    foreach ($oldPermissions as $old) {
                        $old->delete();
                    }
                }
            }
            //Validation
            $validator = $this->validateInput($request->all(), $role->rules, $role->messages);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            //Save role table
            $role->name = $request->name;
            $role->save();
            //Save permission_role table
            foreach ($request->permission_id as $permission_id) {
                $permissionRole = new PermissionRole();
                $permissionRole->role_id = $role->id;
                $permissionRole->permission_id = $permission_id;
                $permissionRole->save();
            }
            return redirect(route('admin.roles.index'))->with('success', __('general.create_success'));
        } catch (\Exception $e) {
            return redirect(route('admin.roles.index'))->with('fail', __('general.create_fail'));
        }
    }

    //Delete one role
    public function destroy(Request $request)
    {
        try {
            Role::findOrFail($request->id)->delete();
            return redirect()->back()->with('success', __('general.delete_success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

    //Delete row selected
    public function destroySelect(Request $request) {
        try {
            $allVals = explode( ',', $request->allValsDelete[0]);
            foreach ($allVals as $item) {
                Role::findOrFail($item)->delete();
            }
            return redirect()->back()->with('success', __('general.delete_success'));
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }








    public function entry(Request $request)
    {
        $permission_logic = new PermissionLogic();
        $permission_list = $permission_logic->getListPermissionGroupByScreen();
        $choose_permission = [];
        $role = ($request->id) ? Role::find($request->id) : [];
        if ($request->id) {
            $choose_permission = DB::table('permission_role')
                ->select('permission_id')
                ->where('role_id', $request->id)
                ->pluck('permission_id')
                ->all();
        }
        return view('admin.role.edit-add', compact(
            'role',
            'permission_list',
            'choose_permission'
        ));
    }

    public function show(Request $request)
    {

        $role = Role::find($request->id);
        return view('admin.role.show', compact('role'));
    }

}
