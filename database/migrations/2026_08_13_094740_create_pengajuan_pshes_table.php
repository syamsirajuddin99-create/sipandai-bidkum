<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_pshes', function (Blueprint $table) {
            $table->id();

            // User Wabprof yang membuat pengajuan
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Satker pengirim
            $table->foreignId('satker_id')
                ->constrained('satkers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Status progres saat ini
            $table->foreignId('status_progres_id')
                ->constrained('status_progres')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->dateTime('waktu_input');

            $table->string('perihal');
            $table->longText('ringkasan_kasus');

            // File PDF yang diupload Wabprof
            $table->string('file_pemohon');

            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->index('nomor_surat');
            $table->index('waktu_input');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pshes');
    }
};