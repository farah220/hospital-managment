<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OnePrescriptionResource;
use App\Http\Resources\PrescriptionResource;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
            $prescriptions = Auth::guard('api')->user()->prescriptions;

            if (isset($prescriptions)){

                return PrescriptionResource::collection($prescriptions);
            }
            return response()->json([
                'message' => 'no prescription',
            ]);

    }

    public function show(Prescription $prescription)
    {
            $prescription->load('user');
            $checks_price = $prescription->checks->pluck('price')->toArray();
            $medicines_price = $prescription->medicines->pluck('price')->toArray();
            $checks = $prescription->checks->map(fn($check)=>['name'=> $check->name,'price'=> $check->price]);
            $medicines = $prescription->medicines->map(fn($medicine)=>['name'=> $medicine->name,'price'=> $medicine->price]);
            $prescription['checks'] =$checks;
            $prescription['medicines'] = $medicines;
            $prescription['medicines_total'] =  array_sum($medicines_price);
            $prescription['checks_total'] =  array_sum($checks_price);
            return new OnePrescriptionResource($prescription);

}

}
