<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mechanic extends Model
{
    use HasFactory, softDeletes;

    public function work()
    {
        return $this->hasOne(Work::class);
    }

    public function workCar()
    {
        return $this->hasOneThrough(Car::class, Work::class);
    }

    public function workUser()
    {
        return $this->hasOneThrough(User::class, Work::class);
    }
}
