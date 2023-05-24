<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OnePrescriptionResource extends JsonResource
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
            'doctor_name' => $this->doctor->name,
            'medicines' => $this->medicines,
            'checks' =>$this->checks,
            'medicines_total' =>$this->medicines_total,
            'checks_total' =>$this->checks_total,
            'date' => date("m-d-Y" , strtotime($this->created_at)),
            'total_price' => $this->total_price,
            'diagnosis' => $this->diagnosis,
            'user'=> new UserResource($this->whenLoaded('user')),

        ];
    }
}
