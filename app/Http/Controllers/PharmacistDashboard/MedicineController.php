<?php

namespace App\Http\Controllers\PharmacistDashboard;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{

    public function index()
    {
        $medicines = Medicine::paginate(3);
        return view('pharmacist-dashboard.medicines.index',compact('medicines'));
    }

    public function create()
    {
        return view('pharmacist-dashboard.medicines.create');
    }

    public function show(Medicine $medicine)
    {
        return view('pharmacist-dashboard.medicines.show',compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        return view('pharmacist-dashboard.medicines.edit',compact('medicine'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'price' => ['required'],
        ]);

        Medicine::create($attributes);

        return redirect()->route('dashboard.medicines.index')->with('success_message','The new medicine has been added successfully');

    }

    public function update(Medicine $medicine,Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'price' => ['required'],
        ]);

        $medicine->update($attributes);

        return redirect()->route('dashboard.medicines.index')->with('success_message','The medicine has been updated successfully');

    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('dashboard.medicines.index')->with('success_message','The medicine has been deleted successfully');
    }
}
