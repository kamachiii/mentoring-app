<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // 'password' => 'hashed', // [HAPUS] Ini sudah otomatis oleh Laravel jika password diisi di fillable dan di-hash saat pembuatan
            'role' => 'string', // [TAMBAH] Menganggap 'role' sebagai string (sesuai enum)
        ];
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function presences()
    {
        
        return $this->hasMany(Presence::class, 'user_id');
    }

    public function schedules()
    {
        
        return $this->hasMany(Schedule::class, 'user_id');
    }

    public function mentoringGroup()
    {
        return $this->belongsTo(MentoringGroup::class, 'mentoring_group_id', 'id');
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    
    public function isMentor(): bool
    {
        return $this->role === 'mentor';
    }

    public function isUser(): bool 
    {
        return $this->role === 'user';
    }
}

// namespace App\Models;

// // use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

// class User extends Authenticatable
// {
//     /** @use HasFactory<\Database\Factories\UserFactory> */
//     use HasFactory, Notifiable;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var list<string>
//      */
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//         'role',
//         'profile_picture'
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var list<string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }

//     public function discussions()
//     {
//         return $this->hasMany(Discussion::class);
//     }

//     public function comments()
//     {
//         return $this->hasMany(Comment::class);
//     }

//     public function presences()
//     {
//         return $this->hasMany(Presence::class);
//     }

//     public function schedules()
//     {
//         return $this->hasMany(Schedule::class, 'users_id');
//     }

//     public function hasRole(string $role): bool
//     {
//         return $this->role === $role;
//     }
// }
