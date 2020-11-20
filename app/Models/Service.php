<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    public function requests()
    {
        return $this->belongsToMany(Request::class)->withTimestamps()->withTrashed();
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class)->withTrashed();
    }
}
