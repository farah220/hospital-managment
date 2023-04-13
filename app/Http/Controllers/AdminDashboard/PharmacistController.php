<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacistController extends Controller
{
    public function index()
    {
        $pharmacists = Pharmacist::paginate(3);
        return view('dashboard.pharmacists.index',compact('pharmacists'));
    }

    public function create()
    {
        return view('dashboard.pharmacists.create');
    }

    public function show(Pharmacist $pharmacist)
    {
        return view('dashboard.pharmacists.show',compact('pharmacist'));
    }

    public function edit(Pharmacist $pharmacist)
    {
        return view('dashboard.pharmacists.edit',compact('pharmacist'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'phone' => ['required' , 'unique:pharmacists'],
            'email' => ['required' , 'unique:pharmacists'],
            'image' => ['required' , 'unique:pharmacists'],
        ]);

        $attributes['password'] = $attributes['phone'];
        $attributes['image'] = uploadImage($request->file('image'),'pharmacists');


        Pharmacist::create($attributes);

        return redirect()->route('dashboard.pharmacists.index')->with('success_message','The new pharmacist has been added successfully');

    }

    public function update(Pharmacist $pharmacist,Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
//            'phone' => ['required' , 'unique:$pharmacists,phone,'. $pharmacist->id],
            'email' => ['required' , 'unique:pharmacists,email,' . $pharmacist->id ,'email'],
            'image' => [ 'nullable' ],
        ]);

        $pharmacist->update($attributes);

        return redirect()->route('dashboard.pharmacists.index')->with('success_message','The pharmacist has been updated successfully');

    }

    public function destroy(Pharmacist $pharmacist)
    {
        $pharmacist->delete();
        return redirect()->route('dashboard.pharmacists.index')->with('success_message','The pharmacist has been deleted successfully');
    }

}
