<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::paginate(3);
        return view('dashboard.departments.index',compact('departments'));
    }

    public function create()
    {
        return view('dashboard.departments.create');
    }

    public function show(Department $department)
    {
        return view('dashboard.departments.show',compact('department'));
    }

    public function edit(Department $department)
    {
        return view('dashboard.departments.edit',compact('department'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
        ]);

        $attributes['image'] = uploadImage($request->file('image'),'departments');
        $attributes['created_by'] = Auth::guard('admins')->user()->id;

        Department::create($attributes);

        return redirect()->route('dashboard.departments.index')->with('success_message','The new department has been added successfully');

    }

    public function update(Department $department,Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'image' => ['nullable']
        ]);
        if ( request()->file('image') )
            $attributes['image'] = uploadImage($request->file('image'),'departments');
        $attributes['created_by'] = Auth::guard('admins')->user()->id;

        $department->update($attributes);

        return redirect()->route('dashboard.departments.index')->with('success_message','The department has been updated successfully');

    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('dashboard.departments.index')->with('success_message','The department has been deleted successfully');
    }
}
