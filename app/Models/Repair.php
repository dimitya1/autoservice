<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repair extends Model
{
    use HasFactory, softDeletes;

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function tools()
    {
        return $this->belongsToMany(Tool::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}
