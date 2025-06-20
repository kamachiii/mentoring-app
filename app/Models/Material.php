<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'title',
        'description',
        'file_path',
    ];
    
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
