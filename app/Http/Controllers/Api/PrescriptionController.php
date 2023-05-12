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
        if(auth('api')->check()){

            $prescriptions = Auth::guard('api')->user()->prescriptions;

            if (isset($prescriptions)){

                return PrescriptionResource::collection($prescriptions);
            }
            return response()->json([
                'message' => 'no prescription',
            ]);
        }
        return response()->json([
            'status' => false,
            'errNum' => '401',
            'message' => 'Unauthorized',
        ]);


    }
    public function show(Prescription $prescription)
    {
        if(auth('api')->check()){

            $prescription['checks_name'] = $prescription->checks->pluck('name')->toArray();
            $prescription['checks_price'] = $prescription->checks->pluck('price')->toArray();
            $prescription['medicines_name'] =$prescription->medicines->pluck('name')->toArray();
            $prescription['medicines_price'] =$prescription->medicines->pluck('price')->toArray();
            $prescription['medicines_total'] =  array_sum($prescription->medicines_price);
            $prescription['checks_total'] =  array_sum($prescription->checks_price);
        return new OnePrescriptionResource($prescription);
        }

        return response()->json([
            'status' => false,
            'errNum' => '401',
            'message' => 'Unauthorized',
        ]);
}
}
