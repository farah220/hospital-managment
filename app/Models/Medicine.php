<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    public function prescriptions()
    {
       return $this->morphToMany(Prescription::class,'prescriptive')->withPivot('item_price');

    }
}
