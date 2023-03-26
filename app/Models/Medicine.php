<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    public function prescriptions()
    {
        $this->belongsToMany(Prescription::class,'prescription_medicines')->withPivot('price');

    }
}
