<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
   public function dashboardLogin(Request $request)
   {
       $credentials = $request->validate([
           'email' => [ 'required', 'email' , 'max:255','exists:admins'],
           'password' => [ 'required', 'min:8'],
       ]);

       if( auth('admins')->attempt($credentials) )
       {
           return redirect('/dashboard');
       }

       throw ValidationException::withMessages(['password' => 'invalid password']);
   }
   public function DoctorDashboardLogin(Request $request)
   {
       $credentials = $request->validate([
           'email' => [ 'required', 'email' , 'max:255','exists:doctors'],
           'password' => [ 'required', 'min:8'],
       ]);

       if( auth('doctors')->attempt($credentials) )
       {
           return redirect('/doctor-dashboard');
       }

       throw ValidationException::withMessages(['password' => 'invalid password']);
   }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('web.index');
    }


public function PharmacistDashboardLogin(Request $request)
   {
       $credentials = $request->validate([
           'email' => [ 'required', 'email' , 'max:255','exists:pharmacists'],
           'password' => [ 'required', 'min:8'],
       ]);

       if( auth('pharmacists')->attempt($credentials) )
       {
           return redirect('/pharmacist-dashboard');
       }

       throw ValidationException::withMessages(['password' => 'invalid password']);
   }


 public function LaboratoristDashboardLogin(Request $request)
   {
       $credentials = $request->validate([
           'email' => [ 'required', 'email' , 'max:255','exists:laboratorists'],
           'password' => [ 'required', 'min:8'],
       ]);

       if( auth('laboratorists')->attempt($credentials) )
       {
           return redirect('/laboratorist-dashboard');
       }

       throw ValidationException::withMessages(['password' => 'invalid password']);
   }



}
