<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrescriptionResource;
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

}
