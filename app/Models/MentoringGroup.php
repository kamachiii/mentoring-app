<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentoringGroup extends Model
{
    protected $table = 'mentoring_group';

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
