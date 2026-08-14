<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_psh_id',
        'agenda_id',
        'user_id',
        'isi_disposisi',
        'file_disposisi',
        'waktu_disposisi',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'waktu_disposisi' => 'datetime',
        ];
    }

    public function pengajuanPsh(): BelongsTo
    {
        return $this->belongsTo(PengajuanPsh::class);
    }

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}