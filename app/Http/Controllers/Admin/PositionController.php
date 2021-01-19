<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends AdminController
{
    //Index
    public function index(Request $request) {
        $this->authorize('position-access');

        $key = isset($request->key) ? $request->key : '';
        $position = new Position();
        $positions = $position->getAll($key, 10);
        if (isset($request->amount)) {
            $positions = $position->getAll($key, $request->amount);
        }
        return view('admin.position.index', compact('positions'));
    }

    //Show row with key
    public function searchRow(Request $request) {
        $position = new Position();
        $positions = $position->getAll($request->key, 10);
        if ($request->amount !== null) {
            $positions = $position->getAll($request->key, $request->amount);
        }
        return view('admin.position.search-row', compact('positions'));
    }

    //Show create form
    public function createForm(Request $request) {
        $position = Position::find($request->id);
        return view('admin.position.edit-add', compact('position'));
    }

    //Save to db
    public function store(Request $request) {
        try {
            $position = new Position();
            //Create position code
            $position->createCode($request->name);
            if ($request->id)  {
                $position = Position::find($request->id);
                $position->rules['name'] = 'required|unique:positions,name,'.$position->id.',id,deleted_at,NULL';
            }
            //Validation
            $validator = $this->validateInput($request->all(), $position->rules, $position->messages);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            //Save row
            $position->name = $request->name;
            $position->description = $request->description;
            $position->save();
            return redirect(route('admin.positions.index'))->with('success', __('general.create_success'));
        } catch (\Exception $exception) {
            return redirect(route('admin.positions.index'))->with('fail', __('general.create_fail'));
        }
    }

    //Delete 1 row
    public function destroy(Request $request) {
        try {
            Position::findOrFail($request->id)->delete();
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
                Position::findOrFail($item)->delete();
            }
            return redirect()->back()->with('success', __('general.delete_success'));
        }
        catch (\Exception $exception) {
            return redirect()->back()->with('fail', __('general.delete_fail'));
        }
    }
}
