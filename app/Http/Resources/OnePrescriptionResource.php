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
            'doctor name' => $this->doctor->name,
            'patient' => $this->user->name,
            'medicines name' => $this->medicines_name,
            'medicines prices' =>$this->medicines_price,
            'checks prices' =>$this->checks_price,
            'checks names' =>$this->checks_name,
            'medicines total' =>$this->medicines_total,
            'checks total' =>$this->checks_total,
            'date' => date("m-d-Y" , strtotime($this->created_at)),
            'total price' => $this->total_price,
        ];
    }
}
