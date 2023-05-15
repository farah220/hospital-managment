<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CheckResultResource;
use App\Http\Resources\OneCheckResultResource;
use App\Models\CheckResult;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckResultController extends Controller
{
    public function index()
    {

        $prescriptions = Auth::guard('api')->user()->prescriptions;
        $presc_ids = $prescriptions->pluck('id')->toArray();
        $checks_result = CheckResult::all();
        foreach ($checks_result as $c){
        foreach ($presc_ids as $p){
        if($c->prescription_id === $p){
            $checks[]= $c;
           }

        }}


        if (isset($checks)){
        foreach ($checks as $c){
            $c['checks'] = $c->prescription->checks->pluck('name')->toArray();
            $c['doctors'] = $c->prescription->doctor->name;
        }

    return CheckResultResource::collection($checks);

}
        return response()->json([
            'message' => 'no reports',
        ]);
    }



    public function show(CheckResult $checkResult)
    {

        $checkResult['checks'] =$checkResult->prescription->checks->pluck('name')->toArray();
        $checks_result_images = $checkResult->CheckResultImages->pluck('name')->toArray();

        foreach($checks_result_images as $c){
              $images[]=getImagePath(imageName:$c,folder:'images');
            }
        $checkResult['checks_result_img'] = $images;
        $checkResult['doctor'] = $checkResult->prescription->doctor->name;

            return new OneCheckResultResource($checkResult);
    }


}
