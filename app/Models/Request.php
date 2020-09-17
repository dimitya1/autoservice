<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, softDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function worklists()
    {
        return $this->belongsToMany(Worklist::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
