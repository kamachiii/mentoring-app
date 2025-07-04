<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    /** @use HasFactory<\Database\Factories\PresenceFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
