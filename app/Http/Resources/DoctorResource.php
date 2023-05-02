<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
              'name' => $this->name,
            'image' =>$this->image,
            'price' => $this->price,
            'email' => $this->email,
            'description' => $this->description,
            'phone'=>$this->phone,
            'department' => $this->department->name,
            'date'=>date("m-d-Y" , strtotime($this->created_at))
        ];
    }
}
