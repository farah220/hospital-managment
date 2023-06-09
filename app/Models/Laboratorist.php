<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Laboratorist extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];

    public function setPasswordAttribute($value)
    {
       return $this->attributes['password'] = Hash::make($value);
    }
    public function admin()
    {
        return  $this->belongsTo(Admin::class,'created_by');
    }
}
