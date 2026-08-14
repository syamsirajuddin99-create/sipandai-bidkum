// database/migrations/YYYY_MM_DD_XXXXXX_add_isi_penugasan_to_penugasan_pshes_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penugasan_pshes', function (Blueprint $table) {
            $table->text('isi_penugasan')
                ->nullable()
                ->after('waktu_penugasan');
        });
    }

    public function down(): void
    {
        Schema::table('penugasan_pshes', function (Blueprint $table) {
            $table->dropColumn('isi_penugasan');
        });
    }
};