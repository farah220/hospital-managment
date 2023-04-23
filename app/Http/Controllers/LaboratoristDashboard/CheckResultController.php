<?php

namespace App\Http\Controllers\LaboratoristDashboard;

use App\Http\Controllers\Controller;
use App\Models\CheckResult;
use App\Models\CheckResultImage;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CheckResultController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::paginate(4);

        foreach ($prescriptions as $p){
            $p['checks_names'] =implode(' , ', $p->checks->pluck('name')->toArray());
            $p['medicines'] =implode(' , ', $p->medicines->pluck('name')->toArray());

        }
        return view('laboratorist-dashboard.checkResults.index',compact('prescriptions'));

    }

    public function addView(Prescription $prescription)
    {
        $prescription['checks_names'] =implode('  ,    ', $prescription->checks->pluck('name')->toArray());

        return view('laboratorist-dashboard.checkResults.addResult',compact('prescription'));
    }
    public function show(Prescription $prescription)
    {
        $prescription['checks_names'] =implode('  ,    ', $prescription->checks->pluck('name')->toArray());
        $checks_result_images = $prescription->checkResult->CheckResultImages->pluck('name');
        $checks_result = $prescription->checkResult;
        return view('laboratorist-dashboard.checkResults.show',compact('prescription','checks_result_images','checks_result'));
    }
    public function addCheckResult(Prescription $prescription,Request $request)
    {
// dd(CheckResult::find(11)->CheckResultImages->pluck('name'));
        $checkResult = new CheckResult();
        $checkResult->checks_report = $request->input('checks_report');
        $checkResult->xray_report = $request->input('xray_report');
        $checkResult->prescription_id = $prescription->id;
        $checkResult->lab_id = auth()->user()->id;

        $checkResult->status ='Done';
        $checkResult->save();
        $checks_images = $request->images;
        if(isset($checks_images)){
            foreach ($checks_images as $check_image){
                $image = new CheckResultImage();
                $image->checkResult_id = $checkResult->id;
                $image->name = uploadImage($check_image,'images');
                $image->save();
            }
        }
        return redirect(route('dashboard.checkResults.index'))->with('success_message','The new Report has been added successfully');
    }
}
