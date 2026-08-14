<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusProgres extends Model
{
    use HasFactory;

    protected $table = 'status_progres';

    protected $fillable = [
        'kode',
        'nama',
        'warna',
        'keterangan',
        'is_active',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'urutan' => 'integer',
        ];
    }

    public function pengajuanPshes(): HasMany
    {
        return $this->hasMany(PengajuanPsh::class);
    }
}