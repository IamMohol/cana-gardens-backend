<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'event_type',
        'estimated_guests',
        'event_date',
        'message',
        'status',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'event_date' => 'date',
        'estimated_guests' => 'integer',
    ];
}
