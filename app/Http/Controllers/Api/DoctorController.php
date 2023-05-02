<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return DoctorResource::collection(Doctor::all());

    }

    public function myDoctors()
    {
        if(auth('api')->check())
        {

        $prescriptions = auth('api')->user()->prescriptions;

        foreach ($prescriptions as $p) {
            $doc_id[] = $p->doctor_id;
            $doctors = Doctor::find($doc_id);
        }

    return DoctorResource::collection($doctors);
    }
        return response()->json([
            'status' => false,
            'errNum' => '401',
            'message' => 'Unauthorized',
        ]);

    }

    public function show(Doctor $doctor)
    {
        if(auth('api')->check())
        {
            return new DoctorResource($doctor);
        }
        return response()->json([
            'status' => false,
            'errNum' => '401',
            'message' => 'Unauthorized',
        ]);

}
}
