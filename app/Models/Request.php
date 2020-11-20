<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)->withTimestamps()->withTrashed();
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class)->withTrashed();
    }

    public function car()
    {
        return $this->belongsTo(Car::class)->withTrashed();
    }
}
