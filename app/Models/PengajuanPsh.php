<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class PengajuanPsh extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_pshes';

    protected $fillable = [
        'user_id',
        'satker_id',
        'status_progres_id',
        'nomor_surat',
        'tanggal_surat',
        'waktu_input',
        'perihal',
        'ringkasan_kasus',
        'file_pemohon',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_surat' => 'date',
            'waktu_input' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function satker(): BelongsTo
    {
        return $this->belongsTo(Satker::class);
    }

    public function statusProgres(): BelongsTo
    {
        return $this->belongsTo(StatusProgres::class);
    }

    public function agenda(): HasOne
    {
        return $this->hasOne(Agenda::class, 'pengajuan_psh_id');
    }

    public function disposisi(): HasOne
    {
        return $this->hasOne(Disposisi::class);
    }

    public function hasilPsh(): HasOne
    {
        return $this->hasOne(HasilPsh::class, 'pengajuan_psh_id');
    }
}



// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

// class PengajuanPsh extends Model
// {
//     use HasFactory;

//     protected $table = 'pengajuan_pshes';

//     protected $fillable = [
//         'user_id',
//         'satker_id',
//         'status_progres_id',
//         'nomor_surat',
//         'tanggal_surat',
//         'waktu_input',
//         'perihal',
//         'ringkasan_kasus',
//         'file_pemohon',
//         'catatan',
//     ];

//     protected function casts(): array
//     {
//         return [
//             'tanggal_surat' => 'date',
//             'waktu_input' => 'datetime',
//         ];
//     }

//     public function user(): BelongsTo
//     {
//         return $this->belongsTo(User::class);
//     }

//     public function satker(): BelongsTo
//     {
//         return $this->belongsTo(Satker::class);
//     }

//     public function statusProgres(): BelongsTo
//     {
//         return $this->belongsTo(StatusProgres::class);
//     }

//     public function agenda(): \Illuminate\Database\Eloquent\Relations\HasOne
//     {
//         return $this->hasOne(Agenda::class);
//     }

//     public function disposisi(): \Illuminate\Database\Eloquent\Relations\HasOne
//     {
//         return $this->hasOne(Disposisi::class);
//     }

//     public function hasilPsh(): \Illuminate\Database\Eloquent\Relations\HasOne
//     {
//         return $this->hasOne(HasilPsh::class);
//     }
// }