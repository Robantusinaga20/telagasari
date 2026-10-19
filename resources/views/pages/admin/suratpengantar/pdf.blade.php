<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi Surat Pengantar KK & KTP</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 15px;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
        }
        h3, p {
            margin: 0;
            padding: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed; /* agar lebar kolom tetap */
        }
        th, td {
            border: 1px solid #333;
            padding: 4px;
            text-align: center;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        th {
            background-color: #f2f2f2;
            font-size: 9px;
        }
        td {
            font-size: 8px;
        }
        /* Lebar kolom baru (setelah Jenis Surat dihapus) */
        th:nth-child(1), td:nth-child(1) { width: 3%; }   /* No */
        th:nth-child(2), td:nth-child(2) { width: 5%; }   /* Tgl */
        th:nth-child(3), td:nth-child(3) { width: 15%; }  /* Perihal */
        th:nth-child(4), td:nth-child(4) { width: 8%; }   /* No HP */
        th:nth-child(5), td:nth-child(5) { width: 10%; }  /* Email */
        th:nth-child(6), td:nth-child(6) { width: 12%; }  /* Nama Pemohon */
        th:nth-child(7), td:nth-child(7) { width: 8%; }   /* JK */
        th:nth-child(8), td:nth-child(8) { width: 15%; }  /* Tmpt & tgl lahir */
        th:nth-child(9), td:nth-child(9) { width: 6%; }   /* Agama */
        th:nth-child(10), td:nth-child(10) { width: 7%; } /* Status */
        th:nth-child(11), td:nth-child(11) { width: 8%; } /* Pekerjaan */
        th:nth-child(12), td:nth-child(12) { width: 13%; }/* Alamat */
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>
    <div style="position: absolute; left: 0;">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo" style="height: 60px;">
    </div>
    <div style="text-align: center;">
        <h3 style="text-align: center;">Rekapitulasi Pengajuan Surat Pengantar</h3>
        <p style="text-align: center;">
            Rekap: {{ $jenSurat }} -
            {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->translatedFormat('F Y') }}
        </p>
           <p style="margin: 0;">Desa Telaga Sari - Kecamatan Sunggal Kabupaten Deli Serdang</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl</th>
                <th>Perihal</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Nama Pemohon</th>
                <th>JK</th>
                <th>Tmpt & Tgl Lahir</th>
                <th>Agama</th>
                <th>Status</th>
                <th>Pekerjaan</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suratpengantars as $index => $surat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $surat->created_at->format('j/n/Y') }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td>{{ $surat->nohp }}</td>
                    <td>{{ $surat->email }}</td>
                    <td>{{ $surat->name }}</td>
                    <td>{{ $surat->jen_kel }}</td>
                    <td>{{ $surat->tplahir }}, {{\Carbon\Carbon::parse($surat->tglahir)->locale('id')->translatedFormat('j F Y') }}</td>
                    <td>{{ $surat->agama }}</td>
                    <td>{{ $surat->stat }}</td>
                    <td>{{ $surat->pkerja }}</td>
                    <td>{{ $surat->alamat }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" style="text-align:center;">Tidak ada data pengajuan surat pada bulan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>