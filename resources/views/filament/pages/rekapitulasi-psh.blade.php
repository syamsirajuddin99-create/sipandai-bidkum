<x-filament-panels::page>

    <style>
        @media print {
            body * {
                visibility: hidden !important;
            }

            #rekap-print-area,
            #rekap-print-area * {
                visibility: visible !important;
            }

            #rekap-print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
            }

            .no-print {
                display: none !important;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            th,
            td {
                border: 1px solid #000 !important;
                padding: 8px !important;
                font-size: 11px !important;
            }

            th {
                font-weight: bold !important;
            }
        }
    </style>

    <div id="rekap-print-area">

        <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between no-print">
            <div class="flex-1">
                {{ $this->form }}
            </div>

            {{-- <div>
                <x-filament::button
                    type="button"
                    icon="heroicon-o-printer"
                    onclick="window.print()"
                >
                    Print Rekap
                </x-filament::button>
            </div> --}}
        </div>

        <div class="hidden print:block mb-6 text-center">
            <h1 class="text-xl font-bold">
                REKAPITULASI PENDAPAT DAN SARAN HUKUM
            </h1>

            <p class="mt-2">
                Periode:
                {{ \Carbon\Carbon::parse($data['tanggal_mulai'] ?? now()->startOfMonth())->translatedFormat('d F Y') }}
                s/d
                {{ \Carbon\Carbon::parse($data['tanggal_selesai'] ?? now())->translatedFormat('d F Y') }}
            </p>
        </div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; padding: 1.5rem;">

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