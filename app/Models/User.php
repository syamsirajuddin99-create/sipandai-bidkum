<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasRoles;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'satker_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class);
    }

    public function disposisiKasubbids(): HasMany
    {
        return $this->hasMany(
            DisposisiKasubbid::class,
            'user_id'
        );
    }

    public function penugasanPshes(): HasMany
    {
        return $this->hasMany(
            PenugasanPsh::class,
            'user_id'
        );
    }

    public function penugasanYangDibuat(): HasMany
    {
        return $this->hasMany(
            PenugasanPsh::class,
            'ditugaskan_oleh'
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function hasAnySystemRole(array $roles): bool
    {
        return $this->hasAnyRole($roles);
    }
}

// namespace App\Models;

// use Filament\Models\Contracts\FilamentUser;
// use Filament\Panel;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Spatie\Permission\Traits\HasRoles;

// class User extends Authenticatable implements FilamentUser
// {
//     use HasRoles;
//     use Notifiable;

//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//         'satker_id',
//     ];

//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }

//     public function satker()
//     {
//         return $this->belongsTo(Satker::class);
//     }

//     public function canAccessPanel(Panel $panel): bool
//     {
//         return true;
//     }

//     public function hasAnySystemRole(array $roles): bool
//     {
//         return $this->hasAnyRole($roles);
//     }
// }

