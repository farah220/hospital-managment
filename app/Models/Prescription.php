<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
   protected $guarded = [];
    public function checks()
    {
       return $this->morphedByMany(Check::class,'prescriptive')->withPivot('item_price');
    }

    public function medicines()
    {
      return  $this->morphedByMany(Medicine::class,'prescriptive')->withPivot('item_price');
    }

    public function checkResult()
    {
        return $this->hasOne(CheckResult::class)->with('CheckResultImages');
    }

    public function getItemsSum()
    {
        $total = 0;
        $total += $this->checks->sum(function($check) {
            return $check->pivot->item_price;
        });


        $total += $this->medicines->sum(function($medicine) {
            return $medicine->pivot->item_price;
        });

        return $total;
    }
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function doctor()
    {
      return  $this->belongsTo(Doctor::class);
    }
}
