<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckResult extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function CheckResultImages()
    {
        return $this->hasMany(CheckResultImage::class,'checkResult_id');
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class,'prescription_id')->with('medicines','checks');
    }

    public function laboratorist()
    {
        return $this->belongsTo(Laboratorist::class,'lab_id');
}
}
