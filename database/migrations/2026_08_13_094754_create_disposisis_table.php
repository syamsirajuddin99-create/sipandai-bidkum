<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_psh_id')
                ->unique()
                ->constrained('pengajuan_pshes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('agenda_id')
                ->unique()
                ->constrained('agendas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // User Bidkum yang membuat disposisi
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->longText('isi_disposisi');

            // Jika disposisi juga dibuat/upload dalam bentuk PDF
            $table->string('file_disposisi')->nullable();

            $table->dateTime('waktu_disposisi');

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};