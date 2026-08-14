// resources/views/filament/pages/rekapitulasi-psh.blade.php

<x-filament-panels::page>

    <div class="space-y-6">

        {{-- FILTER REKAP --}}
        <x-filament::section>
            <x-slot name="heading">
                Filter Periode Rekapitulasi
            </x-slot>

            <x-slot name="description">
                Pilih periode tanggal untuk menampilkan rekapitulasi PSH.
            </x-slot>

            <div class="space-y-4">
                {{ $this->form }}

                <div class="flex justify-end">
                    <x-filament::button
                        wire:click="tampilkanRekap"
                        icon="heroicon-m-magnifying-glass"
                    >
                        Tampilkan Rekap
                    </x-filament::button>
                </div>
            </div>
        </x-filament::section>


        {{-- HEADER REKAP --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-xl font-bold tracking-tight">
                    Ringkasan Rekapitulasi PSH
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Periode:
                    <span class="font-medium">
                        {{ $data['tanggal_mulai'] ?? '-' }}
                    </span>
                    s/d
                    <span class="font-medium">
                        {{ $data['tanggal_selesai'] ?? '-' }}
                    </span>
                </p>
            </div>

            <div>
                <x-filament::button
                    color="gray"
                    icon="heroicon-m-printer"
                    onclick="window.print()"
                >
                    Print Rekap
                </x-filament::button>
            </div>
        </div>


        {{-- STATISTIK --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <x-filament::section>
                <div class="text-sm font-medium text-gray-500">
                    Total Pengajuan PSH
                </div>

                <div class="mt-2 text-3xl font-bold">
                    {{ $rekap['total_pengajuan'] ?? 0 }}
                </div>

                <div class="mt-1 text-xs text-gray-400">
                    Seluruh pengajuan pada periode
                </div>
            </x-filament::section>


            <x-filament::section>
                <div class="text-sm font-medium text-gray-500">
                    Pending Verifikasi
                </div>

                <div class="mt-2 text-3xl font-bold text-warning-600">
                    {{ $rekap['pending_verifikasi'] ?? 0 }}
                </div>

                <div class="mt-1 text-xs text-gray-400">
                    Menunggu proses verifikasi
                </div>
            </x-filament::section>


            <x-filament::section>
                <div class="text-sm font-medium text-gray-500">
                    Sudah Diagendakan
                </div>

                <div class="mt-2 text-3xl font-bold text-info-600">
                    {{ $rekap['sudah_diagendakan'] ?? 0 }}
                </div>

                <div class="mt-1 text-xs text-gray-400">
                    Telah memiliki nomor agenda
                </div>
            </x-filament::section>


            <x-filament::section>
                <div class="text-sm font-medium text-gray-500">
                    Disposisi Kabidkum
                </div>

                <div class="mt-2 text-3xl font-bold text-primary-600">
                    {{ $rekap['disposisi_kabidkum'] ?? 0 }}
                </div>

                <div class="mt-1 text-xs text-gray-400">
                    Telah didisposisikan pimpinan
                </div>
            </x-filament::section>


            <x-filament::section>
                <div class="text-sm font-medium text-gray-500">
                    Disposisi Kasubbid
                </div>

                <div class="mt-2 text-3xl font-bold text-primary-600">
                    {{ $rekap['disposisi_kasubbid'] ?? 0 }}
                </div>

                <div class="mt-1 text-xs text-gray-400">
                    Telah diteruskan ke Kasubbid
                </div>
            </x-filament::section>


            <x-filament::section>
                <div class="text-sm font-medium text-gray-500">
                    Personel Ditugaskan
                </div>

                <div class="mt-2 text-3xl font-bold text-info-600">
                    {{ $rekap['personel_ditugaskan'] ?? 0 }}
                </div>

                <div class="mt-1 text-xs text-gray-400">
                    Personel telah menerima penugasan
                </div>
            </x-filament::section>


            <x-filament::section>
                <div class="text-sm font-medium text-gray-500">
                    PSH Selesai
                </div>

                <div class="mt-2 text-3xl font-bold text-success-600">
                    {{ $rekap['psh_selesai'] ?? 0 }}
                </div>

                <div class="mt-1 text-xs text-gray-400">
                    Hasil penyelesaian telah diunggah
                </div>
            </x-filament::section>

        </div>


        {{-- DETAIL REKAP --}}
        <x-filament::section>
            <x-slot name="heading">
                Detail Rekapitulasi PSH
            </x-slot>

            <x-slot name="description">
                Data pengajuan PSH pada periode yang dipilih.
            </x-slot>

            @if (!empty($pengajuans) && count($pengajuans) > 0)

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1200px] text-left text-sm">

                        <thead class="border-b bg-gray-50 dark:bg-white/5">
                            <tr>
                                <th class="px-4 py-3 font-semibold">No</th>
                                <th class="px-4 py-3 font-semibold">Nomor Surat</th>
                                <th class="px-4 py-3 font-semibold">Tanggal</th>
                                <th class="px-4 py-3 font-semibold">Satker</th>
                                <th class="px-4 py-3 font-semibold">Perihal</th>
                                <th class="px-4 py-3 font-semibold">Status</th>
                                <th class="px-4 py-3 font-semibold">Agenda</th>
                                <th class="px-4 py-3 font-semibold">Kabidkum</th>
                                <th class="px-4 py-3 font-semibold">Kasubbid</th>
                                <th class="px-4 py-3 font-semibold">Personel</th>
                                <th class="px-4 py-3 font-semibold">Penugasan</th>
                                <th class="px-4 py-3 font-semibold">Hasil PSH</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @foreach ($pengajuans as $index => $pengajuan)

                                @php
                                    $disposisiKasubbid = $pengajuan->disposisiKasubbid;
                                    $penugasan = $disposisiKasubbid?->penugasanPshes?->first();
                                @endphp

                                <tr class="hover:bg-gray-50 dark:hover:bg-white/5">

                                    <td class="px-4 py-3">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-3 font-medium whitespace-nowrap">
                                        {{ $pengajuan->nomor_surat ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ optional($pengajuan->created_at)->format('d/m/Y H:i') ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $pengajuan->satker?->nama ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 max-w-xs">
                                        {{ $pengajuan->perihal ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="inline-flex rounded-full bg-success-50 px-2 py-1 text-xs font-medium text-success-700">
                                            {{ $pengajuan->statusProgres?->nama ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $pengajuan->agenda?->nomor_agenda ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ optional($pengajuan->disposisi?->waktu_disposisi)->format('d/m/Y H:i') ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ optional($disposisiKasubbid?->waktu_disposisi)->format('d/m/Y H:i') ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $penugasan?->personel?->nama ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ optional($penugasan?->waktu_penugasan)->format('d/m/Y H:i') ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ optional($pengajuan->hasilPsh?->waktu_upload)->format('d/m/Y H:i') ?? '-' }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>

            @else

                <div class="py-12 text-center text-gray-500">
                    Tidak ada data PSH pada periode yang dipilih.
                </div>

            @endif

        </x-filament::section>

    </div>

</x-filament-panels::page>


{{-- <x-filament-panels::page>

    <div class="mb-6">
        {{ $this->form }}
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

        <x-filament::section>
            <x-slot name="heading">
                Total Pengajuan PSH
            </x-slot>

            <div class="text-3xl font-bold">
                {{ $rekap['total_pengajuan'] ?? 0 }}
            </div>

            <div class="mt-2 text-sm text-gray-500">
                Pengajuan pada periode terpilih
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Pending Verifikasi
            </x-slot>

            <div class="text-3xl font-bold">
                {{ $rekap['pending_verifikasi'] ?? 0 }}
            </div>

            <div class="mt-2 text-sm text-gray-500">
                Menunggu verifikasi
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Sudah Diagendakan
            </x-slot>

            <div class="text-3xl font-bold">
                {{ $rekap['sudah_diagendakan'] ?? 0 }}
            </div>

            <div class="mt-2 text-sm text-gray-500">
                Telah masuk agenda
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Disposisi Kabidkum
            </x-slot>

            <div class="text-3xl font-bold">
                {{ $rekap['disposisi_kabidkum'] ?? 0 }}
            </div>

            <div class="mt-2 text-sm text-gray-500">
                Telah didisposisikan Kabidkum
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Disposisi Kasubbid
            </x-slot>

            <div class="text-3xl font-bold">
                {{ $rekap['disposisi_kasubbid'] ?? 0 }}
            </div>

            <div class="mt-2 text-sm text-gray-500">
                Telah didisposisikan Kasubbid
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Personel Ditugaskan
            </x-slot>

            <div class="text-3xl font-bold">
                {{ $rekap['personel_ditugaskan'] ?? 0 }}
            </div>

            <div class="mt-2 text-sm text-gray-500">
                Telah dilakukan penunjukan personel
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                PSH Selesai
            </x-slot>

            <div class="text-3xl font-bold">
                {{ $rekap['psh_selesai'] ?? 0 }}
            </div>

            <div class="mt-2 text-sm text-gray-500">
                Penyelesaian PSH telah diunggah
            </div>
        </x-filament::section>

    </div>

</x-filament-panels::page> --}}