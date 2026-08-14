<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanSistem extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_sistems';

    protected $fillable = [
        'key',
        'label',
        'value',
        'type',
        'keterangan',
    ];
}