<?php

namespace Database\Seeders;

use App\Models\Satker;
use App\Models\StatusProgres;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SipandaiSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ROLE
        |--------------------------------------------------------------------------
        */

        $roles = [
            'super_admin',
            'wabprof',
            'admin_bidkum',
            'bidkum',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        $superAdmin = User::updateOrCreate(
            [
                'email' => 'superadmin@sipandai.test',
            ],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin12345!'),
            ]
        );

        $superAdmin->assignRole('super_admin');

        /*
        |--------------------------------------------------------------------------
        | WABPROF
        |--------------------------------------------------------------------------
        */

        $wabprof = User::updateOrCreate(
            [
                'email' => 'wabprof@sipandai.test',
            ],
            [
                'name' => 'Wabprof',
                'password' => Hash::make('Wabprof12345!'),
            ]
        );

        $wabprof->assignRole('wabprof');

        /*
        |--------------------------------------------------------------------------
        | ADMIN BIDKUM
        |--------------------------------------------------------------------------
        */

        $adminBidkum = User::updateOrCreate(
            [
                'email' => 'adminbidkum@sipandai.test',
            ],
            [
                'name' => 'Admin Bidkum',
                'password' => Hash::make('AdminBidkum12345!'),
            ]
        );

        $adminBidkum->assignRole('admin_bidkum');

        /*
        |--------------------------------------------------------------------------
        | BIDKUM
        |--------------------------------------------------------------------------
        */

        $bidkum = User::updateOrCreate(
            [
                'email' => 'bidkum@sipandai.test',
            ],
            [
                'name' => 'Bidkum',
                'password' => Hash::make('Bidkum12345!'),
            ]
        );

        $bidkum->assignRole('bidkum');

        /*
        |--------------------------------------------------------------------------
        | STATUS PROGRES
        |--------------------------------------------------------------------------
        */

        $statuses = [
            [
                'kode' => 'PENDING_VERIFIKASI',
                'nama' => 'Pending Verifikasi',
                'warna' => 'warning',
                'keterangan' => 'Pengajuan menunggu verifikasi dan agenda Admin Bidkum.',
                'urutan' => 1,
            ],
            [
                'kode' => 'SUDAH_DIAGENDAKAN',
                'nama' => 'Sudah Diagendakan',
                'warna' => 'info',
                'keterangan' => 'Pengajuan telah diberikan nomor agenda.',
                'urutan' => 2,
            ],
            [
                'kode' => 'DISPOSISI_PIMPINAN',
                'nama' => 'Disposisi Pimpinan',
                'warna' => 'primary',
                'keterangan' => 'Pengajuan sedang dalam proses disposisi pimpinan.',
                'urutan' => 3,
            ],
            [
                'kode' => 'SELESAI',
                'nama' => 'Selesai',
                'warna' => 'success',
                'keterangan' => 'Hasil PSH telah diupload dan proses selesai.',
                'urutan' => 4,
            ],
        ];

        foreach ($statuses as $status) {
            StatusProgres::updateOrCreate(
                [
                    'kode' => $status['kode'],
                ],
                array_merge(
                    $status,
                    ['is_active' => true]
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SATKER CONTOH
        |--------------------------------------------------------------------------
        */

        $satkers = [
            [
                'kode' => 'POLDA-SULSEL',
                'nama' => 'Polda Sulawesi Selatan',
            ],
            [
                'kode' => 'POLRESTABES-MKS',
                'nama' => 'Polrestabes Makassar',
            ],
            [
                'kode' => 'POLRES-GOWA',
                'nama' => 'Polres Gowa',
            ],
            [
                'kode' => 'POLRES-MAROS',
                'nama' => 'Polres Maros',
            ],
        ];

        foreach ($satkers as $satker) {
            Satker::updateOrCreate(
                [
                    'kode' => $satker['kode'],
                ],
                array_merge(
                    $satker,
                    ['is_active' => true]
                )
            );
        }
    }
}