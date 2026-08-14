{{-- resources/views/laporan/rekapitulasi-psh-print.blade.php --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Rekapitulasi PSH</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #000;
            margin: 25px;
            font-size: 11px;
        }

        .header {
            display: table;
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .logo {
            display: table-cell;
            width: 90px;
            vertical-align: middle;
        }

        .logo img {
            width: 70px;
            height: auto;
        }

        .title {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            padding-right: 90px;
        }

        .title h1 {
            margin: 0;
            font-size: 18px;
        }

        .title h2 {
            margin: 5px 0 0;
            font-size: 14px;
            font-weight: normal;
        }

        .periode {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .summary td {
            border: 1px solid #000;
            padding: 8px;
        }

        .summary .label {
            font-weight: bold;
            width: 35%;
        }

        .summary .value {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            width: 15%;
        }

        .detail {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        .detail th,
        .detail td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }

        .detail th {
            text-align: center;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
        }

        .no-print {
            margin-bottom: 20px;
        }

        @media print {

            @page {
                size: landscape;
                margin: 10mm;
            }

            body {
                margin: 0;
            }

            .no-print {
                display: none;
            }

        }

    </style>
</head>

<body>

    <div class="no-print">
        <button onclick="window.print()">
            🖨 Cetak Rekapitulasi
        </button>
    </div>


    <div class="header">

        <div class="logo">
            <img
                src="{{ asset('images/Logo Baru Sipandai.png') }}"
                alt="Logo"
            >
        </div>

        <div class="title">

            <h1>
                REKAPITULASI PENDAPAT DAN SARAN HUKUM
            </h1>

            <h2>
                BIDANG HUKUM POLDA SULAWESI SELATAN
            </h2>

        </div>

    </div>


    <div class="periode">

        <strong>PERIODE:</strong>

        {{ $tanggalMulai->format('d F Y') }}

        s.d.

        {{ $tanggalSelesai->format('d F Y') }}

    </div>


    <table class="summary">

        <tr>
            <td class="label">
                Total Pengajuan PSH
            </td>

            <td class="value">
                {{ $rekap['total_pengajuan'] }}
            </td>

            <td class="label">
                Pending Verifikasi
            </td>

            <td class="value">
                {{ $rekap['pending_verifikasi'] }}
            </td>
        </tr>

        <tr>
            <td class="label">
                Sudah Diagendakan
            </td>

            <td class="value">
                {{ $rekap['sudah_diagendakan'] }}
            </td>

            <td class="label">
                Disposisi Kabidkum
            </td>

            <td class="value">
                {{ $rekap['disposisi_kabidkum'] }}
            </td>
        </tr>

        <tr>
            <td class="label">
                Disposisi Kasubbid
            </td>

            <td class="value">
                {{ $rekap['disposisi_kasubbid'] }}
            </td>

            <td class="label">
                Personel Ditugaskan
            </td>

            <td class="value">
                {{ $rekap['personel_ditugaskan'] }}
            </td>
        </tr>

        <tr>
            <td class="label">
                PSH Selesai
            </td>

            <td class="value">
                {{ $rekap['psh_selesai'] }}
            </td>

            <td colspan="2"></td>
        </tr>

    </table>


    <h3>
        DETAIL PENGAJUAN PSH
    </h3>


    <table class="detail">

        <thead>

            <tr>

                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tanggal</th>
                <th>Satker</th>
                <th>Perihal</th>
                <th>Status</th>
                <th>Agenda</th>
                <th>Disposisi Kabidkum</th>
                <th>Hasil PSH</th>

            </tr>

        </thead>

        <tbody>

            @forelse ($pengajuans as $index => $pengajuan)

                <tr>

                    <td class="center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $pengajuan->nomor_surat ?? '-' }}
                    </td>

                    <td>
                        {{ $pengajuan->created_at?->format('d/m/Y H:i') ?? '-' }}
                    </td>

                    <td>
                        {{ $pengajuan->satker?->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $pengajuan->perihal ?? '-' }}
                    </td>

                    <td>
                        {{ $pengajuan->statusProgres?->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $pengajuan->agenda?->nomor_agenda ?? '-' }}
                    </td>

                    <td>
                        {{ $pengajuan->disposisi?->waktu_disposisi?->format('d/m/Y H:i') ?? '-' }}
                    </td>

                    <td>
                        {{ $pengajuan->hasilPsh?->waktu_upload?->format('d/m/Y H:i') ?? '-' }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td
                        colspan="9"
                        class="center"
                    >
                        Tidak ada data pada periode ini.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>


    <div class="footer">

        Dicetak pada:
        {{ now()->format('d/m/Y H:i') }}

    </div>

</body>

</html>