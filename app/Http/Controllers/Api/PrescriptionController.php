<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OnePrescriptionResource;
use App\Http\Resources\PrescriptionResource;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {       $user = auth('api')->user()->id;
            $prescriptions = Prescription::query()->where('user_id',$user);

            if (isset($prescriptions)){
                $prescriptions->when(request('start') && request('end'),
                    fn($query)=>$query->whereBetween('created_at',
                        [Carbon::createFromFormat('d/m/Y', request('start'))->format('Y-m-d').' 00:00:00',
                        Carbon::createFromFormat('d/m/Y', request('end'))->format('Y-m-d').' 23:59:59']));
                return PrescriptionResource::collection($prescriptions->get());
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
