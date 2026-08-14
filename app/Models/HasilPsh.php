<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilPsh extends Model
{
    use HasFactory;

    protected $table = 'hasil_pshes';

    protected $fillable = [
        'pengajuan_psh_id',
        'personel_id',
        'user_id',
        'file_hasil_psh',
        'waktu_upload',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'waktu_upload' => 'datetime',
        ];
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

// class HasilPsh extends Model
// {
//     use HasFactory;

//     protected $table = 'hasil_pshes';

//     protected $fillable = [
//         'pengajuan_psh_id',
//         'user_id',
//         'file_hasil_psh',
//         'waktu_upload',
//         'catatan',
//     ];

//     protected function casts(): array
//     {
//         return [
//             'waktu_upload' => 'datetime',
//         ];
//     }

//     public function pengajuanPsh(): BelongsTo
//     {
//         return $this->belongsTo(PengajuanPsh::class, 'pengajuan_psh_id');
//     }

//     public function user(): BelongsTo
//     {
//         return $this->belongsTo(User::class);
//     }
// }