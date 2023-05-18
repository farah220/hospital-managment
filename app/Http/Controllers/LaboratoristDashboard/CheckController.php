<?php

namespace App\Http\Controllers\LaboratoristDashboard;

use App\Http\Controllers\Controller;
use App\Models\Check;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Laboratorist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{

    public function index()
    {
        $checks = Check::paginate(5);
        return view('laboratorist-dashboard.checks.index', compact('checks'));
    }

    public function create()
    {
        return view('laboratorist-dashboard.checks.create');
    }

    public function show(Check $check)
    {
        return view('laboratorist-dashboard.checks.show', compact('check'));
    }

    public function edit(Check $check)
    {
        return view('laboratorist-dashboard.checks.edit', compact('check'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'price' => ['required'],
        ]);
        Check::create($attributes);


        return redirect()->route('lab-dashboard.checks.index')->with('success_message', 'The new check has been added successfully');

    }

    public function update(Check $check, Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'price' => ['required'],

        ]);


        $check->update($attributes);

        return redirect()->route('lab-dashboard.checks.index')->with('success_message', 'The check has been updated successfully');

    }

    public function destroy(Check $check)
    {
        $check->delete();
        return redirect()->route('lab-dashboard.checks.index')->with('success_message', 'The check has been deleted successfully');
    }

    public function logOut()
    {
        Auth::guard('laboratorists')->logout();
        return redirect()->route('laboratorist.login-form');
    }
}
