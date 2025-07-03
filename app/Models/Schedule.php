<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        
        return $this->belongsTo(User::class, 'user_id');
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }
}
// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Schedule extends Model
// {
//     /** @use HasFactory<\Database\Factories\ScheduleFactory> */
//     use HasFactory;

//     protected $fillable = [
//         'users_id',
//         'date',
//         'start_time',
//         'end_time',
//         'topic',
//         'description',
//     ];

//     public function user()
//     {
//         return $this->belongsTo(User::class, 'users_id');
//     }
    
//     public function presences()
//     {
//         return $this->hasMany(Presence::class);
//     }
// }
