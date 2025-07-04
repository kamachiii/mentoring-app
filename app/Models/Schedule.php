<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'mentoring_group_id',
        'date',
        'location',
        'start_time',
        'end_time',
        'topic',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }
}
