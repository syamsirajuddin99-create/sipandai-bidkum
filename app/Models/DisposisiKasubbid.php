<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisposisiKasubbid extends Model
{
    use HasFactory;

    protected $table = 'disposisi_kasubbids';

    protected $fillable = [
        'disposisi_id',
        'pengajuan_psh_id',
        'user_id',
        'isi_disposisi',
        'waktu_disposisi',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'waktu_disposisi' => 'datetime',
        ];
    }

    public function disposisi(): BelongsTo
    {
        return $this->belongsTo(Disposisi::class);
    }

    public function pengajuanPsh(): BelongsTo
    {
        return $this->belongsTo(PengajuanPsh::class, 'pengajuan_psh_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function penugasanPshes(): HasMany
    {
        return $this->hasMany(
            PenugasanPsh::class,
            'disposisi_kasubbid_id'
        );
    }
}