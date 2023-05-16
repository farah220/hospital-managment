<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CheckResultResource;
use App\Http\Resources\OneCheckResultResource;
use App\Models\CheckResult;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckResultController extends Controller
{
    public function index()
    {
        $prescriptions = Auth::guard('api')->user()->prescriptions;
        $presc_ids = $prescriptions->pluck('id')->toArray();
        $checks_result = CheckResult::query()->whereIn('prescription_id',$presc_ids);
        if (isset($checks_result)){

        $checks_result->when(request('start') && request('end'),fn($query)=>$query->whereBetween('created_at',
            [Carbon::createFromFormat('d/m/Y', request('start'))->format('Y-m-d').' 00:00:00',
             Carbon::createFromFormat('d/m/Y', request('end'))->format('Y-m-d').' 23:59:59']));
             return CheckResultResource::collection($checks_result->get());
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
