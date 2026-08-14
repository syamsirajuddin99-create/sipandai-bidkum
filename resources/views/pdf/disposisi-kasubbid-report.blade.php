<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <style>
        @page {
            margin: 30px 35px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3,
        .header p {
            margin: 3px 0;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail td {
            padding: 7px 4px;
            vertical-align: top;
        }

        .detail .label {
            width: 32%;
            font-weight: bold;
        }

        .detail .separator {
            width: 3%;
        }

        .box {
            border: 1px solid #000;
            padding: 12px;
            min-height: 70px;
            margin-top: 8px;
        }

        .signature {
            width: 45%;
            margin-left: auto;
            margin-top: 45px;
            text-align: center;
        }

        .signature .space {
            height: 70px;
        }

        .personel {
            margin-top: 15px;
        }

        .personel table,
        .personel th,
        .personel td {
            border: 1px solid #000;
        }

        .personel th,
        .personel td {
            padding: 7px;
        }

        .personel th {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>KEPOLISIAN NEGARA REPUBLIK INDONESIA</h2>
        <h2>DAERAH SULAWESI SELATAN</h2>
        <h3>BIDANG HUKUM</h3>
        <p>MAKASSAR</p>
    </div>

    <div class="title">
        DISPOSISI KASUBBID
    </div>

    <table class="detail">
        <tr>
            <td class="label">Nomor Surat</td>
            <td class="separator">:</td>
            <td>
                {{ $disposisiKasubbid->pengajuanPsh?->nomor_surat ?? '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Satker</td>
            <td class="separator">:</td>
            <td>
                {{ $disposisiKasubbid->pengajuanPsh?->satker?->nama ?? '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Perihal</td>
            <td class="separator">:</td>
            <td>
                {{ $disposisiKasubbid->pengajuanPsh?->perihal ?? '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Disposisi Kabidkum Oleh</td>
            <td class="separator">:</td>
            <td>
                {{ $disposisiKasubbid->disposisi?->user?->name ?? '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Disposisi Kasubbid Oleh</td>
            <td class="separator">:</td>
            <td>
                {{ $disposisiKasubbid->user?->name ?? '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Waktu Disposisi</td>
            <td class="separator">:</td>
            <td>
                {{ $disposisiKasubbid->waktu_disposisi?->format('d F Y H:i') ?? '-' }}
            </td>
        </tr>
    </table>

    <p><strong>ISI DISPOSISI</strong></p>

    <div class="box">
        {!! nl2br(e($disposisiKasubbid->isi_disposisi ?? '-')) !!}
    </div>

    @if($disposisiKasubbid->catatan)
        <p><strong>CATATAN</strong></p>

        <div class="box">
            {!! nl2br(e($disposisiKasubbid->catatan)) !!}
        </div>
    @endif

    @if($disposisiKasubbid->penugasanPshes->count())
        <div class="personel">
            <p><strong>PERSONEL YANG DITUNJUK</strong></p>

            <table>
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama Personel</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($disposisiKasubbid->penugasanPshes as $index => $penugasan)
                        <tr>
                            <td style="text-align: center">
                                {{ $index + 1 }}
                            </td>

                            <td>
                                {{ $penugasan->personel?->name ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="signature">
        <p>
            Makassar,
            {{ $disposisiKasubbid->waktu_disposisi?->format('d F Y') ?? now()->format('d F Y') }}
        </p>

        <p>
            <strong>Kasubbid</strong>
        </p>

        <div class="space"></div>

        <p>
            <strong>
                {{ $disposisiKasubbid->user?->name ?? '-' }}
            </strong>
        </p>
    </div>

</body>
</html>