<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pengantar</title>
    <style>
        @page {
            size: A4;
            margin: 25mm 20mm 25mm 20mm;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 20px;
            position: relative;
        }
        .kop-surat img {
            position: absolute;
            left: 0;
            top: 0;
            height: 70px;
        }
        .kop-surat h3, .kop-surat p {
            margin: 0;
            line-height: 1; /* rapat */
        }
        .judul-surat {
            text-align: center;
            font-weight: bold;
            margin: 20px 0 5px 0;
            text-transform: uppercase;
        }
        .content { margin-top: 10px; }
        .data table {
            width: 100%;
            border-collapse: collapse;
        }
        .data td {
            padding: 2px 4px;
            vertical-align: top;
        }
        .data td.label {
            width: 180px;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
            line-height: 1; /* rapat */
        }
        .signature p {
            margin: 2px 0; /* rapat antara tanggal dan hormat saya */
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo">
        <h3>PEMERINTAH KABUPATEN DELI SERDANG</h3>
        <h3>KECAMATAN SUNGGAL</h3>
        <h3>DESA TELAGA SARI</h3>
        <p>Alamat: Jl. Diski Glugur Rimbun No.180, Sunggal - Deli Serdang</p>
    </div>

    <!-- Judul -->
    <h3 class="judul-surat">Surat Pengantar</h3>
    <p style="text-align: center; margin-bottom: 20px;">
        Nomor Surat: {{ $surat->id }}/DS-TS/{{ \Carbon\Carbon::now()->format('Y') }}
    </p>

    <!-- Pembuka -->
    <p>Dengan hormat,</p>
    <p>
        Saya yang beratasnamakan di bawah ini telah mengajukan permohonan
        <strong>{{ $surat->jen_surat }}</strong> pada laman web Desa Telaga Sari
        dengan data sebagai berikut:
    </p>

    <!-- Data Pemohon (Tabel) -->
    <div class="content data">
        <table>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td>: {{ $surat->name }}</td>
            </tr>
            <tr>
                <td class="label">Tempat, Tanggal Lahir</td>
                <td>: {{ $surat->tplahir }}, {{ \Carbon\Carbon::parse($surat->tglahir)->locale('id')->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Agama</td>
                <td>: {{ $surat->agama }}</td>
            </tr>
            <tr>
                <td class="label">Status Perkawinan</td>
                <td>: {{ $surat->stat }}</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan</td>
                <td>: {{ $surat->pkerja }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td>: {{ $surat->alamat }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Pengajuan</td>
                <td>: {{ \Carbon\Carbon::parse($surat->created_at)->locale('id')->translatedFormat('d F Y, H:i') }} WIB</td>
            </tr>
        </table>
    </div>

    <!-- Penutup -->
    <p style="margin-top:20px;">
        Sebagai pendukung, saya akan melampirkan dokumen tambahan.
        Melalui pengajuan ini saya harap surat saya dapat segera ditindaklanjuti 
        dan atas perhatiannya saya ucapkan terima kasih.
    </p>

    <!-- Tanda Tangan -->
    <div class="signature">
        <p>Telaga Sari, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</p>
        <p>Hormat saya,</p>
        <br><br><br>
        <br><br><br>
        <p><strong>{{ $surat->name }}</strong></p>
    </div>
</body>
</html>