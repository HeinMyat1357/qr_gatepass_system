<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatePassLog extends Model
{
    protected $table = 'gate_pass_logs';

    // Allow mass assignment on these columns
    protected $fillable = [
        'user_id',
        'temporary_pass_id',
        'user_type_id',
        'location_id',
        'scan_type',
        'scanned_at',
    ];

    // Casts
    protected $casts = [
        'scanned_at' => 'datetime',
    ];

    /**
     * Relationships
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visitor()
    {
        return $this->belongsTo(TemporaryPass::class, 'temporary_pass_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
}
