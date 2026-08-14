<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disposisi_kasubbids', function (Blueprint $table) {
            $table->id();

            $table->foreignId('disposisi_id')
                ->unique()
                ->constrained('disposisis')
                ->cascadeOnDelete();

            $table->foreignId('pengajuan_psh_id')
                ->unique()
                ->constrained('pengajuan_pshes')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->text('isi_disposisi');

            $table->dateTime('waktu_disposisi');

            $table->text('catatan')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disposisi_kasubbids');
    }
};