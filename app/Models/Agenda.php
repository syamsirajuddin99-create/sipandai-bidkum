<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_psh_id',
        'user_id',
        'nomor_agenda',
        'waktu_agenda',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'waktu_agenda' => 'datetime',
        ];
    }

    public function pengajuanPsh(): BelongsTo
    {
        return $this->belongsTo(PengajuanPsh::class, 'pengajuan_psh_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function disposisi(): HasOne
{
    return $this->hasOne(Disposisi::class);
}

    // public function disposisi(): \Illuminate\Database\Eloquent\Relations\HasOne
    // {
    //     return $this->hasOne(Disposisi::class);
    // }
}