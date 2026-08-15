<?php

namespace App\Filament\Pages;

use App\Models\Disposisi;
use App\Models\DisposisiKasubbid;
use App\Models\HasilPsh;
use App\Models\PenugasanPsh;
use App\Models\PengajuanPsh;
use App\Support\AccessControl;
use BackedEnum;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class RekapitulasiPsh extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedDocumentChartBar;

    protected static ?string $navigationLabel = 'Rekapitulasi PSH';

    protected static ?string $title = 'Rekapitulasi PSH';

    protected static string|\UnitEnum|null $navigationGroup = 'PSH';

    protected static ?int $navigationSort = 7;

    protected string $view = 'filament.pages.rekapitulasi-psh';

    public ?array $data = [];

    public array $rekap = [];

    /*
    |--------------------------------------------------------------------------
    | ACCESS CONTROL
    |--------------------------------------------------------------------------
    | Hanya Super Admin dan Admin Bidkum
    | yang dapat melihat menu Rekapitulasi PSH.
    */

    public static function shouldRegisterNavigation(): bool
    {
        return AccessControl::hasAnyRole([
            'super_admin',
            'admin_bidkum',
        ]);
    }

    public static function canAccess(): bool
    {
        return AccessControl::hasAnyRole([
            'super_admin',
            'admin_bidkum',
        ]);
    }

    public function mount(): void
    {
        abort_unless(static::canAccess(), 403);

        $this->form->fill([
            'tanggal_mulai' => now()->startOfMonth()->toDateString(),
            'tanggal_selesai' => now()->toDateString(),
        ]);

        $this->tampilkanRekap();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required()
                    ->native(false),

                DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->required()
                    ->native(false),
            ])
            ->statePath('data');
    }

    public function tampilkanRekap(): void
    {
        $data = $this->form->getState();

        $tanggalMulai = Carbon::parse(
            $data['tanggal_mulai']
        )->startOfDay();

        $tanggalSelesai = Carbon::parse(
            $data['tanggal_selesai']
        )->endOfDay();

        $this->rekap = [
            'total_pengajuan' => PengajuanPsh::query()
                ->whereBetween('created_at', [
                    $tanggalMulai,
                    $tanggalSelesai,
                ])
                ->count(),

            'pending_verifikasi' => PengajuanPsh::query()
                ->whereBetween('created_at', [
                    $tanggalMulai,
                    $tanggalSelesai,
                ])
                ->whereHas(
                    'statusProgres',
                    fn ($query) => $query->where(
                        'nama',
                        'Pending Verifikasi'
                    )
                )
                ->count(),

            'sudah_diagendakan' => PengajuanPsh::query()
                ->whereBetween('created_at', [
                    $tanggalMulai,
                    $tanggalSelesai,
                ])
                ->whereHas(
                    'statusProgres',
                    fn ($query) => $query->where(
                        'nama',
                        'Sudah Diagendakan'
                    )
                )
                ->count(),

            'disposisi_kabidkum' => Disposisi::query()
                ->whereBetween('waktu_disposisi', [
                    $tanggalMulai,
                    $tanggalSelesai,
                ])
                ->count(),

            'disposisi_kasubbid' => DisposisiKasubbid::query()
                ->whereBetween('waktu_disposisi', [
                    $tanggalMulai,
                    $tanggalSelesai,
                ])
                ->count(),

            'personel_ditugaskan' => PenugasanPsh::query()
                ->whereBetween('waktu_penugasan', [
                    $tanggalMulai,
                    $tanggalSelesai,
                ])
                ->count(),

            'psh_selesai' => HasilPsh::query()
                ->whereBetween('waktu_upload', [
                    $tanggalMulai,
                    $tanggalSelesai,
                ])
                ->count(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('tampilkanRekap')
                ->label('Tampilkan Rekap')
                ->icon(Heroicon::OutlinedMagnifyingGlass)
                ->action('tampilkanRekap'),
        ];
    }
}

// namespace App\Filament\Pages;

// use App\Models\Disposisi;
// use App\Models\DisposisiKasubbid;
// use App\Models\HasilPsh;
// use App\Models\PenugasanPsh;
// use App\Models\PengajuanPsh;
// use BackedEnum;
// use Carbon\Carbon;
// use Filament\Actions\Action;
// use Filament\Forms\Components\DatePicker;
// use Filament\Pages\Page;
// use Filament\Schemas\Schema;
// use Filament\Support\Icons\Heroicon;

// class RekapitulasiPsh extends Page
// {
//     protected static string|BackedEnum|null $navigationIcon =
//         Heroicon::OutlinedDocumentChartBar;

//     protected static ?string $navigationLabel = 'Rekapitulasi PSH';

//     protected static ?string $title = 'Rekapitulasi PSH';

//     protected static string|\UnitEnum|null $navigationGroup = 'PSH';

//     protected static ?int $navigationSort = 7;

//     protected string $view = 'filament.pages.rekapitulasi-psh';

//     public ?array $data = [];

//     public array $rekap = [];

//     public array $detailPshes = [];

//     public function mount(): void
//     {
//         $this->form->fill([
//             'tanggal_mulai' => now()->startOfMonth()->toDateString(),
//             'tanggal_selesai' => now()->toDateString(),
//         ]);

//         $this->tampilkanRekap();
//     }

//     public function form(Schema $schema): Schema
//     {
//         return $schema
//             ->components([
//                 DatePicker::make('tanggal_mulai')
//                     ->label('Tanggal Mulai')
//                     ->required()
//                     ->native(false),

//                 DatePicker::make('tanggal_selesai')
//                     ->label('Tanggal Selesai')
//                     ->required()
//                     ->native(false),
//             ])
//             ->columns(2)
//             ->statePath('data');
//     }

//     public function tampilkanRekap(): void
//     {
//         $data = $this->form->getState();

//         $tanggalMulai = Carbon::parse(
//             $data['tanggal_mulai']
//         )->startOfDay();

//         $tanggalSelesai = Carbon::parse(
//             $data['tanggal_selesai']
//         )->endOfDay();

//         $this->rekap = [
//             'total_pengajuan' => PengajuanPsh::query()
//                 ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
//                 ->count(),

//             'pending_verifikasi' => PengajuanPsh::query()
//                 ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
//                 ->whereHas(
//                     'statusProgres',
//                     fn ($query) => $query->where('nama', 'Pending Verifikasi')
//                 )
//                 ->count(),

//             'sudah_diagendakan' => PengajuanPsh::query()
//                 ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
//                 ->whereHas(
//                     'statusProgres',
//                     fn ($query) => $query->where('nama', 'Sudah Diagendakan')
//                 )
//                 ->count(),

//             'disposisi_kabidkum' => Disposisi::query()
//                 ->whereBetween(
//                     'waktu_disposisi',
//                     [$tanggalMulai, $tanggalSelesai]
//                 )
//                 ->count(),

//             'disposisi_kasubbid' => DisposisiKasubbid::query()
//                 ->whereBetween(
//                     'waktu_disposisi',
//                     [$tanggalMulai, $tanggalSelesai]
//                 )
//                 ->count(),

//             'personel_ditugaskan' => PenugasanPsh::query()
//                 ->whereBetween(
//                     'waktu_penugasan',
//                     [$tanggalMulai, $tanggalSelesai]
//                 )
//                 ->count(),

//             'psh_selesai' => HasilPsh::query()
//                 ->whereBetween(
//                     'waktu_upload',
//                     [$tanggalMulai, $tanggalSelesai]
//                 )
//                 ->count(),
//         ];

//         $this->detailPshes = PengajuanPsh::query()
//             ->with([
//                 'satker',
//                 'statusProgres',
//                 'agenda',
//                 'disposisi',
//                 'hasilPsh',
//             ])
//             ->whereBetween('created_at', [
//                 $tanggalMulai,
//                 $tanggalSelesai,
//             ])
//             ->latest('created_at')
//             ->get()
//             ->map(function (PengajuanPsh $pengajuan): array {

//                 $disposisiKasubbid = DisposisiKasubbid::query()
//                     ->with([
//                         'penugasanPshes.personel',
//                     ])
//                     ->where('pengajuan_psh_id', $pengajuan->id)
//                     ->latest('waktu_disposisi')
//                     ->first();

//                 $penugasan = $disposisiKasubbid
//                     ? $disposisiKasubbid->penugasanPshes
//                         ->sortByDesc('waktu_penugasan')
//                         ->first()
//                     : null;

//                 return [
//                     'nomor_surat' => $pengajuan->nomor_surat ?? '-',

//                     'tanggal_pengajuan' => $pengajuan->created_at
//                         ? $pengajuan->created_at->format('d/m/Y H:i')
//                         : '-',

//                     'satker' => $pengajuan->satker?->nama ?? '-',

//                     'perihal' => $pengajuan->perihal ?? '-',

//                     'status' => $pengajuan->statusProgres?->nama ?? '-',

//                     'nomor_agenda' =>
//                         $pengajuan->agenda?->nomor_agenda ?? '-',

//                     'disposisi_kabidkum' =>
//                         $pengajuan->disposisi?->waktu_disposisi
//                             ? Carbon::parse(
//                                 $pengajuan->disposisi->waktu_disposisi
//                             )->format('d/m/Y H:i')
//                             : '-',

//                     'disposisi_kasubbid' =>
//                         $disposisiKasubbid?->waktu_disposisi
//                             ? Carbon::parse(
//                                 $disposisiKasubbid->waktu_disposisi
//                             )->format('d/m/Y H:i')
//                             : '-',

//                     'personel' =>
//                         $penugasan?->personel?->nama ?? '-',

//                     'waktu_penugasan' =>
//                         $penugasan?->waktu_penugasan
//                             ? Carbon::parse(
//                                 $penugasan->waktu_penugasan
//                             )->format('d/m/Y H:i')
//                             : '-',

//                     'waktu_selesai' =>
//                         $pengajuan->hasilPsh?->waktu_upload
//                             ? Carbon::parse(
//                                 $pengajuan->hasilPsh->waktu_upload
//                             )->format('d/m/Y H:i')
//                             : '-',
//                 ];
//             })
//             ->values()
//             ->all();
//     }

//     public function getTanggalMulaiProperty(): ?string
//     {
//         return $this->data['tanggal_mulai'] ?? null;
//     }

//     public function getTanggalSelesaiProperty(): ?string
//     {
//         return $this->data['tanggal_selesai'] ?? null;
//     }

//     protected function getHeaderActions(): array
//     {
//         return [
//             Action::make('tampilkanRekap')
//                 ->label('Tampilkan Rekap')
//                 ->icon(Heroicon::OutlinedMagnifyingGlass)
//                 ->color('primary')
//                 ->action('tampilkanRekap'),

//             Action::make('cetakRekap')
//                 ->label('Cetak Rekap')
//                 ->icon(Heroicon::OutlinedPrinter)
//                 ->color('success')
//                 ->url(fn (): string => route(
//                     'rekapitulasi-psh.print',
//                     [
//                         'tanggal_mulai' => $this->tanggalMulai,
//                         'tanggal_selesai' => $this->tanggalSelesai,
//                     ]
//                 ))
//                 ->openUrlInNewTab(),
//         ];
//     }
// }