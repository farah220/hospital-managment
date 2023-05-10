<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckResultResource extends JsonResource
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
            'Lab_name' => $this->laboratorist->name,
            'date' => date("m-d-Y" , strtotime($this->created_at)),
            'doctor' => $this->doctors
        ];
    }
}
