<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    public function checks()
    {
        $this->belongsToMany(Check::class,'prescription_checks')->withPivot('price');
    }

    public function medicines()
    {
        $this->belongsToMany(Medicine::class,'prescription_medicines')->withPivot('price');
    }

    public function users()
    {
        $this->belongsTo(User::class);
    }
}
