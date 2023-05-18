<?php

namespace App\Http\Controllers\DoctorDashboard;

use App\Http\Controllers\Controller;
use App\Models\Check;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = auth('doctors')->user()->prescriptions()->paginate(6);

        foreach ($prescriptions as $p){
            $p['checks_names'] =implode(' , ', $p->checks->pluck('name')->toArray());
            $p['medicines'] =implode(' , ', $p->medicines->pluck('name')->toArray());
        }


        return view('doctor-dashboard.prescriptions.index',compact('prescriptions'));

    }

    public function show(Prescription $prescription)
    {
        $prescription['checks_names'] =implode(' , ', $prescription->checks->pluck('name')->toArray());
        $prescription['medicines'] =implode(' , ', $prescription->medicines->pluck('name')->toArray());

        return view('doctor-dashboard.prescriptions.show',compact('prescription'));
    }
    public function edit(Prescription $prescription)
    {   $users = User::all();
        $medicines= Medicine::all();
        $checks= Check::all();
        $checks_id =  $prescription['checks_id'] = $prescription->checks->pluck('id')->toArray();
        $medicines_id =  $prescription['medicines_id'] = $prescription->medicines->pluck('id')->toArray();

        return view('doctor-dashboard.prescriptions.edit',compact('prescription','users','medicines','checks','medicines_id','checks_id'));
    }
    public function create()
    {
        $users = User::all();
        $medicines= Medicine::all();
        $checks= Check::all();
    return view('doctor-dashboard.prescriptions.create',compact('users','medicines','checks'));
}
    public function storePrescription(Request $request)
    {
       $prescription = new Prescription();
       $prescription->user_id = $request->input('user_id');
       $prescription->doctor_id = auth()->user()->id;
       $prescription->total_price = 0;
       $prescription->save();
       $checks = $request->input('checks');
       $medicines = $request->input('medicines');
      if(isset($checks)){
      foreach ($checks as $id)
       {   $check = Check::find($id);
           $prescription->checks()->attach($check,['item_price' => $check->price ]);
       }
       }
        if(isset($medicines)){
        foreach ($medicines as $id)
        {   $medicine = Medicine::find($id);
            $prescription->medicines()->attach($medicine,['item_price' => $medicine->price ]);
        }
        }
        $total = $prescription->getItemsSum();
        $prescription->update(['total_price'=>$total]);
        return redirect(route('doctor-dashboard.prescriptions.index'))->with('success_message','The new prescription has been added successfully');

   }

    public function update(Request $request, Prescription $prescription)
    {
       $user_id = $prescription->user_id = $request->input('user_id');
        $doctor_id = $prescription->doctor_id = auth()->user()->id;
        $prescription->total_price = 0;
        $checks = $request->input('checks');
        $medicines = $request->input('medicines');
        $prescription->checks()->detach();
        $prescription->medicines()->detach();
        if (isset($checks)){
        foreach ($checks as $id)
        {   $check = Check::find($id);
            $prescription->checks()->attach($check,['item_price' => $check->price]);
        }
        }
        if(isset($medicines)){
        foreach ($medicines as $id)
        {   $medicine = Medicine::find($id);
            $prescription->medicines()->attach($medicine,['item_price' => $medicine->price ]);
        }
        }
        $total = $prescription->getItemsSum();
        $prescription->update(['total_price'=>$total,'user_id'=>$user_id,'doctor_id'=>$doctor_id]);

        return redirect(route('doctor-dashboard.prescriptions.index'))->with('success_message','The prescription has been updated successfully');


    }
    public function logOut()
    {
        Auth::guard('doctors')->logout();
        return redirect()->route('doctors.login-form');
    }
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('doctor-dashboard.prescriptions.index')->with('success_message','The prescription has been deleted successfully');
    }

}
