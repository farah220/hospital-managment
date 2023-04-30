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

}
