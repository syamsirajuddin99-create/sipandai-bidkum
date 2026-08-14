<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penugasan_pshes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('disposisi_kasubbid_id')
                ->constrained('disposisi_kasubbids')
                ->cascadeOnDelete();

            $table->foreignId('pengajuan_psh_id')
                ->constrained('pengajuan_pshes')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('ditugaskan_oleh')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->dateTime('waktu_penugasan');

            $table->text('catatan')
                ->nullable();

            $table->string('status')
                ->default('ditugaskan');

            $table->timestamps();

            $table->unique(
                ['disposisi_kasubbid_id', 'user_id'],
                'penugasan_kasubbid_user_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penugasan_pshes');
    }
};