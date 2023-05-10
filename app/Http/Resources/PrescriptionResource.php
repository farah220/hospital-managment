<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
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
            'date' => date("m-d-Y" , strtotime($this->created_at)),
            'total price' => $this->total_price,
        ];
    }
}
