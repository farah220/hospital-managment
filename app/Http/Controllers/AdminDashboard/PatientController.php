<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::paginate(3);
        return view('dashboard.patients.index',compact('patients'));
    }

    public function create()
    {
        return view('dashboard.patients.create');
    }

    public function show(User $patient)
    {
        return view('dashboard.patients.show',compact('patient'));
    }

    public function edit(User $patient)
    {
        return view('dashboard.patients.edit',compact('patient'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'phone' => ['required' , 'unique:users'],
            'email' => ['required' , 'unique:users'],
            'image' => ['required' , 'unique:users'],
            'emergency_contact' => ['required' , 'unique:users'],
        ]);

        $attributes['password'] = $attributes['phone'];
        $attributes['image'] = uploadImage($request->file('image'),'patients');
        $attributes['created_by'] = Auth::guard('admins')->user()->id;



        User::create($attributes);

        return redirect()->route('dashboard.patients.index')->with('success_message','The new patient has been added successfully');

    }

    public function update(User $patient,Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'phone' => ['required' , 'unique:users,phone,' . $patient->id],
            'email' => ['required' , 'unique:users,email,' . $patient->id ,'email'],
            'image' => [ 'nullable' ],
            'emergency_contact' => ['required', 'unique:users,emergency_contact,' . $patient->id],
        ]);
        $attributes['password'] = $attributes['phone'];
        if ( request()->file('image') )
            $attributes['image'] = uploadImage($request->file('image'),'patients');
        $attributes['created_by'] = Auth::guard('admins')->user()->id;


        $patient->update($attributes);

        return redirect()->route('dashboard.patients.index')->with('success_message','The patient has been updated successfully');

    }

    public function destroy(User $patient)
    {
        $patient->delete();
        return redirect()->route('dashboard.patients.index')->with('success_message','The patient has been deleted successfully');
    }

}
