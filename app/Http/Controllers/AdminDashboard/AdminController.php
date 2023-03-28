<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(3);
        return view('dashboard.admins.index',compact('admins'));
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function show(Admin $admin)
    {
        return view('dashboard.admins.show',compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('dashboard.admins.edit',compact('admin'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'phone' => ['required' , 'unique:admins'],
            'email' => ['required' , 'unique:admins'],
        ]);

        $attributes['password'] = $attributes['phone'];

        Admin::create($attributes);

        return redirect()->route('dashboard.admins.index')->with('success_message','The new admin has been added successfully');

    }

    public function update(Admin $admin,Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'phone' => ['required' , 'unique:admins,phone,'. $admin->id],
            'email' => ['required' , 'unique:admins,email,' . $admin->id ,'email'],
        ]);

        $admin->update($attributes);

        return redirect()->route('dashboard.admins.index')->with('success_message','The admin has been updated successfully');

    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('dashboard.admins.index')->with('success_message','The admin has been deleted successfully');
    }
    public function logOut()
    {
        Auth::guard('admins')->logout();
        return redirect()->route('admins.login-form');
    }
}
