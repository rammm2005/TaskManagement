<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::firstOrFail();
        $departments = Department::all();
        return view('admin.department', compact('departments', 'siteSettings'));
    }

    public function create()
    {
        $siteSettings = SiteSetting::firstOrFail();
        return view('admin.departments', compact('siteSettings'));
    }

    public function store(Request $request)
    {
        $department = new Department;
        $department->name = $request->name;
        $department->save();

        return redirect()->route('departement.index')->with('success', 'Department created successfully!');
    }

    public function edit($departmentId)
    {
        $siteSettings = SiteSetting::firstOrFail();
        $department = Department::find($departmentId);
        if (!$department) {
            return abort(404);
        }

        return view('admin.departments', compact('department', 'siteSettings'));
    }

    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        if (!$department) {
            return abort(404);
        }

        $department->name = $request->name;
        $department->save();

        return redirect()->route('departement.index')->with('success', 'Department updated successfully!');
    }

    public function destroy($departmentId)
    {
        $department = Department::find($departmentId);
        if (!$department) {
            return abort(404);
        }

        $department->delete();

        return redirect()->route('departement.index')->with('success', 'Department deleted successfully!');
    }
}
