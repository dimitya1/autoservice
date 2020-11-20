<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repair extends Model
{
    use HasFactory, SoftDeletes;

    public function request()
    {
        return $this->belongsTo(Request::class)->withTrashed();
    }

    public function tools()
    {
        return $this->belongsToMany(Tool::class)->withPivot('used_quantity')->withTimestamps()->withTrashed();
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class)->withTrashed();
    }

    public function service()
    {
        return $this->belongsTo(Service::class)->withTrashed();
    }
}
