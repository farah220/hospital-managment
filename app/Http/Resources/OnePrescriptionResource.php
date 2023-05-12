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
            'medicines_name' => $this->medicines_name,
            'medicines_prices' =>$this->medicines_price,
            'checks_prices' =>$this->checks_price,
            'checks_names' =>$this->checks_name,
            'medicines_total' =>$this->medicines_total,
            'checks_total' =>$this->checks_total,
            'date' => date("m-d-Y" , strtotime($this->created_at)),
            'total_price' => $this->total_price,
            'user'=> new UserResource($this->whenLoaded('user')),

        ];
    }
}
