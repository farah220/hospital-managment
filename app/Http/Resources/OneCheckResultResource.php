<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OneCheckResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'Lab name' => $this->laboratorist->name,
            'doctor' => $this->doctor,
            'patient' => $this->prescription->user->name,
            'date' => date("m-d-Y" , strtotime($this->created_at)),
            'x-ray report'=> $this->xray_report,
            'checks_report' => $this->checks_report,
            'checks result images' =>getImagePath(imageName:$this->checks_result_images,folder:'images'),
            'checks' =>$this->checks,


        ];
    }
}
