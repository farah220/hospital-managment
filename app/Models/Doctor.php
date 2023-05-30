<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Doctor extends Authenticatable
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);

    }
    public function admin()
{
    return  $this->belongsTo(Admin::class,'created_by');
}
    protected $guarded = [];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
