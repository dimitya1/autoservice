<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repair extends Model
{
    use HasFactory;

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function tools()
    {
        return $this->belongsToMany(Tool::class)->withPivot('used_quantity')->withTimestamps();
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
