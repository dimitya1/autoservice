<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function requests()
    {
        return $this->hasMany(Request::class)->withTrashed();
    }

    public function repairs()
    {
        return $this->hasManyThrough(Repair::class, Request::class)->withTrashed();
    }
}
