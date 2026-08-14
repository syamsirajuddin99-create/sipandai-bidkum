<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_psh_id')
                ->unique()
                ->constrained('pengajuan_pshes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Admin yang melakukan agenda
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('nomor_agenda')->unique();
            $table->dateTime('waktu_agenda');

            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->index('nomor_agenda');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};