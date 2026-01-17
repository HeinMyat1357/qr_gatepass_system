<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'name',
        'type',
        'description',
        'access_level_required',
    ];
}
