<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, softDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function work()
    {
        return $this->hasOne(Work::class);
    }

    public function workMechanic()
    {
        return $this->hasOneThrough(Mechanic::class, Work::class);
    }
}
