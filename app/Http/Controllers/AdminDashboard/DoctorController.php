<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{

    public function index()
    {
        $doctors = Doctor::paginate(3);
        return view('dashboard.doctors.index',compact('doctors'));
    }

    public function create()
    {
        return view('dashboard.doctors.create');
    }

    public function show(Doctor $doctor)
    {
        return view('dashboard.doctors.show',compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('dashboard.doctors.edit',compact('doctor'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required' , 'unique:doctors'],
            'price' => ['required' ],
            'description' => ['required'],
            'image' => ['required' , 'unique:doctors'],
            ]);

//        $attributes['password'] = $attributes['phone'];
        $attributes['image'] = uploadImage($request->file('image'),'doctors');


        Doctor::create($attributes);

        return redirect()->route('dashboard.doctors.index')->with('success_message','The new doctor has been added successfully');

    }

    public function update(Doctor $doctor,Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required' , 'unique:doctor,email,' . $doctor->id ,'email'],
            'price' => ['required'  . $doctor->price ,'price'],
            'description' => ['required'. $doctor->description ,'description'],
            'image' => [ 'nullable' ],
        ]);
        if ( request()->file('image') )
            $attributes['image'] = uploadImage($request->file('image'),'doctors');
        $doctor->update($attributes);

        return redirect()->route('dashboard.doctors.index')->with('success_message','The doctor has been updated successfully');

    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('dashboard.doctors.index')->with('success_message','The Doctor has been deleted successfully');
    }
    public function logOut()
    {
        Auth::guard('doctors')->logout();
        return redirect()->route('doctors.login-form');
    }
}
