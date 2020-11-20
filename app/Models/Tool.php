<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tool extends Model
{
    use HasFactory, SoftDeletes;

    public function repairs()
    {
        return $this->belongsToMany(Repair::class)->withPivot('used_quantity')->withTimestamps()->withTrashed();
    }
}
