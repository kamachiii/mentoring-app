<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentoring extends Model
{
    use HasFactory;

    protected $table = 'mentorings';

    protected $fillable = [
        'tema_mentoring',
        'tanggal',
        'tempat',
        'waktu_mulai',
        'waktu_selesai',
        'nama_mentor',
        'nomor',
        'deskripsi',
    ];
}
