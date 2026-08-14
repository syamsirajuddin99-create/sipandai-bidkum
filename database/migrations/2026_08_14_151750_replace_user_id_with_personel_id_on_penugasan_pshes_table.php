<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | HAPUS UNIQUE LAMA + KOLOM user_id DALAM SATU OPERASI
        |--------------------------------------------------------------------------
        |
        | Jangan DROP index secara terpisah karena MySQL masih menganggap
        | index tersebut dipakai oleh foreign key.
        */

        DB::statement("
            ALTER TABLE `penugasan_pshes`
            DROP COLUMN `user_id`
        ");

        /*
        |--------------------------------------------------------------------------
        | TAMBAHKAN personel_id
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE `penugasan_pshes`
            ADD COLUMN `personel_id` BIGINT UNSIGNED NOT NULL
            AFTER `pengajuan_psh_id`
        ");

        /*
        |--------------------------------------------------------------------------
        | FOREIGN KEY personel_id
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE `penugasan_pshes`
            ADD CONSTRAINT `penugasan_pshes_personel_id_foreign`
            FOREIGN KEY (`personel_id`)
            REFERENCES `personels` (`id`)
            ON DELETE CASCADE
        ");

        /*
        |--------------------------------------------------------------------------
        | UNIQUE: SATU PERSONEL TIDAK BOLEH DITUGASKAN DUA KALI
        | PADA DISPOSISI KASUBBID YANG SAMA
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE `penugasan_pshes`
            ADD UNIQUE `penugasan_kasubbid_personel_unique`
            (`disposisi_kasubbid_id`, `personel_id`)
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE `penugasan_pshes`
            DROP FOREIGN KEY `penugasan_pshes_personel_id_foreign`
        ");

        DB::statement("
            ALTER TABLE `penugasan_pshes`
            DROP INDEX `penugasan_kasubbid_personel_unique`
        ");

        DB::statement("
            ALTER TABLE `penugasan_pshes`
            DROP COLUMN `personel_id`
        ");

        DB::statement("
            ALTER TABLE `penugasan_pshes`
            ADD COLUMN `user_id` BIGINT UNSIGNED NOT NULL
            AFTER `pengajuan_psh_id`
        ");

        DB::statement("
            ALTER TABLE `penugasan_pshes`
            ADD INDEX `penugasan_pshes_user_id_foreign` (`user_id`)
        ");

        DB::statement("
            ALTER TABLE `penugasan_pshes`
            ADD UNIQUE `penugasan_kasubbid_user_unique`
            (`disposisi_kasubbid_id`, `user_id`)
        ");
    }
};