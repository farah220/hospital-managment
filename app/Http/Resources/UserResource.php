<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'image' =>getImagePath(imageName:$this->image,folder:'patient'),
            'email' => $this->email,
            'phone'=>$this->phone,
            'emergency contact'=>$this->emergency_contact,
            'date'=>date("m-d-Y" , strtotime($this->created_at))
        ];
    }
}
