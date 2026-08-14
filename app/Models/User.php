<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\HasMany;
// use Spatie\Permission\Traits\HasRoles;

// class User extends Authenticatable
// {
//     use HasFactory, Notifiable, HasRoles;

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

//     public function satker(): BelongsTo
//     {
//         return $this->belongsTo(Satker::class);
//     }

//     public function pengajuanPshes(): HasMany
//     {
//         return $this->hasMany(PengajuanPsh::class);
//     }

//     public function agendas(): HasMany
//     {
//         return $this->hasMany(Agenda::class);
//     }

//     public function disposisis(): HasMany
//     {
//         return $this->hasMany(Disposisi::class);
//     }

//     public function hasilPshes(): HasMany
//     {
//         return $this->hasMany(HasilPsh::class);
//     }
// }