<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Laboratorist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaboratoristController extends Controller
{
    public function index()
    {
        $laboratorists = Laboratorist::paginate(3);
        return view('dashboard.laboratorists.index',compact('laboratorists'));
    }

    public function create()
    {
        return view('dashboard.laboratorists.create');
    }

    public function show(Laboratorist $laboratorist)
    {
        return view('dashboard.laboratorists.show',compact('laboratorist'));
    }

    public function edit(Laboratorist $laboratorist)
    {
        return view('dashboard.laboratorists.edit',compact('laboratorist'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required' , 'unique:laboratorists'],
            'phone' => ['required' , 'unique:laboratorists'],
            'image' => ['required' , 'unique:laboratorists'],

        ]);
        $attributes['password']=$attributes['phone'];
        $attributes['image'] = uploadImage($request->file('image'),'laboratorists');
        $attributes['created_by'] = Auth::guard('admins')->user()->id;



        Laboratorist::create($attributes);


        return redirect()->route('dashboard.laboratorists.index')->with('success_message','The new laboratorist has been added successfully');

    }

    public function update(Laboratorist $laboratorist,Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required' , 'unique:laboratorists,email,' . $laboratorist->id ,'email'],
            'phone' => ['required' , 'unique:laboratorists,phone,' . $laboratorist->id ],
            'image' => [ 'nullable' ],

        ]);
        $attributes['password'] = $attributes['phone'];
        if ( request()->file('image') )
            $attributes['image'] = uploadImage($request->file('image'),'laboratorists');
        $attributes['created_by'] = Auth::guard('admins')->user()->id;

        $laboratorist->update($attributes);

        return redirect()->route('dashboard.laboratorists.index')->with('success_message','The laboratorist has been updated successfully');

    }

    public function destroy(Laboratorist $laboratorist)
    {
        $laboratorist->delete();
        return redirect()->route('dashboard.laboratorists.index')->with('success_message','The laboratorist has been deleted successfully');
    }
    public function logOut()
    {
        Auth::guard('laboratorists')->logout();
        return redirect()->route('laboratorists.login-form');
    }
}
