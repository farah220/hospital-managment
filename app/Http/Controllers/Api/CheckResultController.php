<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CheckResultResource;
use App\Http\Resources\OneCheckResultResource;
use App\Models\CheckResult;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CheckResultController extends Controller
{
    public function index()
    {
        $prescriptions = auth('api')->user()->prescriptions;
        $checks_result =new CheckResult();
        foreach ($prescriptions as $p){
            $checks_result->where('prescription_id','=',$p->id);
        }

        $checks = $checks_result->get();

        foreach ($checks as $c){
            $c['checks'] = $c->prescription->checks->pluck('name')->toArray();
            $c['doctors'] = $c->prescription->doctor->name;

        }
        return CheckResultResource::collection($checks);

}

    public function show(CheckResult $checkResult)
    {
        if(auth('api')->check()){
        $checkResult['checks'] =$checkResult->prescription->checks->pluck('name')->toArray();
        $checkResult['checks_result_images'] = $checkResult->CheckResultImages->pluck('name')->toArray();
        $checkResult['doctor'] = $checkResult->prescription->doctor->name;

            return new OneCheckResultResource($checkResult);
    }
        return response()->json([
            'status' => false,
            'errNum' => '401',
            'message' => 'Unauthorized',
        ]);

    }
}
