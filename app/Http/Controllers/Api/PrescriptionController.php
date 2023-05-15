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
            $checks_p = $prescription->checks;
            $medicines_p = $prescription->medicines;
            foreach ($checks_p as $check){
            $checks_price[] = $check->pivot->item_price;
            }
            foreach ($medicines_p as $medicine){
            $medicines_price[] = $medicine->pivot->item_price;
            }

            $checks = $checks_p->map(fn($check)=>['name'=> $check->name,'price'=> $check->pivot->item_price]);
            $medicines = $medicines_p->map(fn($medicine)=>['name'=> $medicine->name,'price'=> $medicine->pivot->item_price]);
            $prescription['checks'] =$checks;
            $prescription['medicines'] = $medicines;
            $prescription['medicines_total'] =  array_sum($medicines_price);
            $prescription['checks_total'] =  array_sum($checks_price);
            return new OnePrescriptionResource($prescription);

}

}
