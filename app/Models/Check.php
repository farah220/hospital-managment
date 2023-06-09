<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;
protected $guarded=[];
    public function prescriptions()
    {
      return $this->morphToMany(Prescription::class,'prescriptive')->withPivot('item_price');
    }
    public function laboratorist()
    {
        return  $this->belongsTo(Laboratorist::class,'created_by');
    }
}
