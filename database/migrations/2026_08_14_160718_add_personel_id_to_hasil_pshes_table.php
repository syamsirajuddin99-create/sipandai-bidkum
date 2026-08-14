<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_pshes', function (Blueprint $table) {
            $table->foreignId('personel_id')
                ->nullable()
                ->after('pengajuan_psh_id')
                ->constrained('personels')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('hasil_pshes', function (Blueprint $table) {
            $table->dropForeign(['personel_id']);
            $table->dropColumn('personel_id');
        });
    }
};