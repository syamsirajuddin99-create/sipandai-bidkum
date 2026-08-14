<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nrp_nip',
        'nama',
        'pangkat',
        'jabatan',
        'satker',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
        ];
    }

    public function penugasanPshes(): HasMany
    {
        return $this->hasMany(
            PenugasanPsh::class,
            'personel_id'
        );
    }

    public function hasilPshes(): HasMany
    {
        return $this->hasMany(
            HasilPsh::class,
            'personel_id'
        );
    }
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;

// class Personel extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'nrp_nip',
//         'nama',
//         'pangkat',
//         'jabatan',
//         'satker',
//         'aktif',
//     ];

//     protected function casts(): array
//     {
//         return [
//             'aktif' => 'boolean',
//         ];
//     }

//     public function penugasanPshes(): HasMany
//     {
//         return $this->hasMany(PenugasanPsh::class);
//     }
// }