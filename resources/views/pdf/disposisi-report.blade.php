<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <style>
        @page {
            margin: 25px 35px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.5;
        }

        .header {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 65px;
            float: left;
            margin-right: 15px;
        }

        .header-text {
            text-align: center;
        }

        .header-text h2,
        .header-text h3,
        .header-text p {
            margin: 0;
        }

        .clear {
            clear: both;
        }

        .title {
            text-align: center;
            margin: 25px 0;
        }

        .title h3 {
            text-decoration: underline;
            margin: 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table td,
        .table th {
            border: 1px solid #000;
            padding: 7px;
            vertical-align: top;
        }

        .label {
            width: 32%;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 7px;
        }

        .content-box {
            border: 1px solid #000;
            padding: 10px;
            min-height: 50px;
        }

        .signature {
            width: 40%;
            margin-left: auto;
            margin-top: 45px;
            text-align: center;
        }

        .signature-space {
            height: 65px;
        }

        .footer {
            margin-top: 25px;
            font-size: 9px;
            color: #555;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-text">
            <h2>KEPOLISIAN NEGARA REPUBLIK INDONESIA</h2>
            <h2>KEPOLISIAN DAERAH SULAWESI SELATAN</h2>
            <h3>BIDANG HUKUM</h3>
            <p>Jl. Perintis Kemerdekaan Km. 16 Makassar</p>
        </div>

        <div class="clear"></div>
    </div>

    <div class="title">
        <h3>LAPORAN RANGKAIAN PENANGANAN PSH</h3>
        <p>SISTEM INFORMASI PENGAWASAN DAN ADMINISTRASI</p>
    </div>

    <div class="section-title">
        I. DATA PENGAJUAN PSH
    </div>

    <table class="table">
        <tr>
            <td class="label">Nomor Surat</td>
            <td>{{ $pengajuanPsh?->nomor_surat ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Tanggal Surat</td>
            <td>
                {{ $pengajuanPsh?->tanggal_surat
                    ? \Carbon\Carbon::parse($pengajuanPsh->tanggal_surat)->format('d/m/Y')
                    : '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Satker Pemohon</td>
            <td>{{ $pengajuanPsh?->satker?->nama ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Perihal</td>
            <td>{{ $pengajuanPsh?->perihal ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">
        II. RINGKASAN KASUS
    </div>

    <div class="content-box">
        {{ $pengajuanPsh?->ringkasan_kasus ?? '-' }}
    </div>

    <div class="section-title">
        III. VERIFIKASI DAN AGENDA
    </div>

    <table class="table">
        <tr>
            <td class="label">Nomor Agenda</td>
            <td>{{ $agenda?->nomor_agenda ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Waktu Agenda</td>
            <td>
                {{ $agenda?->waktu_agenda
                    ? \Carbon\Carbon::parse($agenda->waktu_agenda)->format('d/m/Y H:i')
                    : '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Petugas Agenda</td>
            <td>{{ $agenda?->user?->name ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Catatan Agenda</td>
            <td>{{ $agenda?->catatan ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">
        IV. DISPOSISI PIMPINAN
    </div>

    <table class="table">
        <tr>
            <td class="label">Waktu Disposisi</td>
            <td>
                {{ $disposisi->waktu_disposisi
                    ? \Carbon\Carbon::parse($disposisi->waktu_disposisi)->format('d/m/Y H:i')
                    : '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Dibuat Oleh</td>
            <td>{{ $disposisi->user?->name ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Isi Disposisi</td>
            <td>{{ $disposisi->isi_disposisi ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Catatan</td>
            <td>{{ $disposisi->catatan ?? '-' }}</td>
        </tr>
    </table>

    <div class="signature">
        <p>Makassar,
            {{ $disposisi->waktu_disposisi
                ? \Carbon\Carbon::parse($disposisi->waktu_disposisi)->translatedFormat('d F Y')
                : now()->translatedFormat('d F Y') }}
        </p>

        <p><strong>PEJABAT YANG MEMBUAT DISPOSISI</strong></p>

        <div class="signature-space"></div>

        <p>
            <strong>{{ strtoupper($disposisi->user?->name ?? '-') }}</strong>
        </p>
    </div>

    <div class="footer">
        Dicetak melalui SIPANDAI BIDKUM
        - Sistem Informasi Pengawasan dan Administrasi
    </div>

</body>
</html>