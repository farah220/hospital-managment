<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function prescriptions()
    {
       return $this->morphToMany(Prescription::class,'prescriptive')->withPivot('item_price');

    }
    public function pharmacist()
    {
        return  $this->belongsTo(Pharmacist::class,'created_by');
    }
}
