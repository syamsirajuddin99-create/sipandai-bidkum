<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenugasanPsh extends Model
{
    use HasFactory;

    protected $table = 'penugasan_pshes';

    protected $fillable = [
        'disposisi_kasubbid_id',
        'pengajuan_psh_id',
        'personel_id',
        'ditugaskan_oleh',
        'waktu_penugasan',
        'isi_penugasan',
        'catatan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'waktu_penugasan' => 'datetime',
        ];
    }

    public function disposisiKasubbid(): BelongsTo
    {
        return $this->belongsTo(
            DisposisiKasubbid::class,
            'disposisi_kasubbid_id'
        );
    }

    public function pengajuanPsh(): BelongsTo
    {
        return $this->belongsTo(
            PengajuanPsh::class,
            'pengajuan_psh_id'
        );
    }

    public function personel(): BelongsTo
    {
        return $this->belongsTo(
            Personel::class,
            'personel_id'
        );
    }

    public function ditugaskanOleh(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'ditugaskan_oleh'
        );
    }
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

// class PenugasanPsh extends Model
// {
//     use HasFactory;

//     protected $table = 'penugasan_pshes';

//     protected $fillable = [
//         'disposisi_kasubbid_id',
//         'pengajuan_psh_id',
//         'personel_id',
//         'ditugaskan_oleh',
//         'waktu_penugasan',
//         'catatan',
//         'status',
//     ];

//     protected function casts(): array
//     {
//         return [
//             'waktu_penugasan' => 'datetime',
//         ];
//     }

//     public function disposisiKasubbid(): BelongsTo
//     {
//         return $this->belongsTo(
//             DisposisiKasubbid::class,
//             'disposisi_kasubbid_id'
//         );
//     }

//     public function pengajuanPsh(): BelongsTo
//     {
//         return $this->belongsTo(
//             PengajuanPsh::class,
//             'pengajuan_psh_id'
//         );
//     }

//     public function personel(): BelongsTo
//     {
//         return $this->belongsTo(
//             Personel::class,
//             'personel_id'
//         );
//     }

//     public function ditugaskanOleh(): BelongsTo
//     {
//         return $this->belongsTo(
//             User::class,
//             'ditugaskan_oleh'
//         );
//     }
// }