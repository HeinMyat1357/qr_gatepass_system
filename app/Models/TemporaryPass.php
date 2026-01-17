<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Note this is User class
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemporaryPass extends Authenticatable
{
    use HasFactory;

    protected $table = 'temporary_passes';

    protected $fillable = [
        'visitor_name',
        'visitor_email',
        'visitor_phone',
        'purpose',
       'password',
        'valid_from',
        'valid_until',
        'qr_code_token',
        'status',
    ];

    protected $hidden = [
        'password',
    ];


   
}
