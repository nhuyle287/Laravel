<?php


namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DepartmentController extends AdminController
{
    //Index
    public function index(Request $request) {
        $key = isset($request->key) ? $request->key : '';
        $department = new Department();
        $departments = $department->getAll($key, 10);
        if (isset($request->amount)) {
            $departments = $department->getAll($key, $request->amount);
        }
        return view('admin.department.index', compact('departments'));
    }

    //Show row with key
    public function searchRow(Request $request) {
        $department = new Department();
        $departments = $department->getAll($request->key, 10);
        if ($request->amount !== null) {
            $departments = $department->getAll($request->key, $request->amount);
        }
        return view('admin.department.search-row', compact('departments'));
    }

    //Create form
    public function createForm(Request $request) {
        $department = Department::find($request->id);
        return view('admin.department.edit-add', compact('department'));
    }

    //Save to db
    public function store(Request $request){
        try {
            $department = new Department();
            //Create department code
            $department->createCode($request->name);
            if ($request->id)  {
                $department = Department::find($request->id);
                $department->rules['name'] = 'required|unique:departments,name,'.$department->id.',id,deleted_at,NULL';
            }
            //Validation
            $validator = $this->validateInput($request->all(), $department->rules, $department->messages);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            //Save row
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();
            return redirect(route('admin.departments.index'))->with('success', __('general.create_success'));
        } catch (\Exception $exception) {
            return redirect(route('admin.departments.index'))->with('fail', __('general.create_fail'));
        }
    }

    //Delete 1 row
    public function destroy(Request $request) {
        try {
            Department::findOrFail($request->id)->delete();
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
                Department::findOrFail($item)->delete();
            }
            return redirect()->back()->with('success', __('general.delete_success'));
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

    //Trash index
    public function trashIndex(Request $request) {
        $key = isset($request->key) ? $request->key : '';
        $department = new Department();
        $departments = $department->getAllTrash($key, 10);
        if (isset($request->amount)) {
            $departments = $department->getAllTrash($key, $request->amount);
        }
        return view('admin.department.trash.index', compact('departments'));
    }

    //Show row - trash
    public function trashSearchRow(Request $request) {
        $department = new Department();
        $departments = $department->getAllTrash($request->key, 10);
        if ($request->amount !== null) {
            $departments = $department->getAllTrash($request->key, $request->amount);
        }
        return view('admin.department.trash.search-row', compact('departments'));
    }

    //Force delete 1 row
    public function forceDelete(Request $request) {
        try {
            Department::withTrashed()->find($request->id)->forceDelete();
            return redirect()->back()->with('success', __('general.delete_success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

    //Force delete row selected
    public function forceDeleteSelect(Request $request) {
        try {
            $allVals = explode(',', $request->allValsDelete[0]);
            foreach ($allVals as $item) {
                Department::withTrashed()->find($item)->forceDelete();
            }
            return redirect()->back()->with('success', __('general.delete_success'));
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }

    //Restore from trash
    public function restore(Request $request) {
        try {
            Department::withTrashed()->find($request->id)->restore();
            return redirect(route('admin.departments.index'))->with('success', __('general.restore_success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.restore_fail'));
        }
    }
}
