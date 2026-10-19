<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi Ajuan Surat Keterangan</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 15px;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
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
            table-layout: fixed;
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
            font-size: 10px;
        }
        td {
            font-size: 9px;
        }
        /* Atur ulang lebar kolom karena Jenis Surat dihapus */
        th:nth-child(1), td:nth-child(1) { width: 3%; }   /* No */
        th:nth-child(2), td:nth-child(2) { width: 5%; }   /* Tanggal */
        th:nth-child(3), td:nth-child(3) { width: 12%; }  /* Nama Pemohon */
        th:nth-child(4), td:nth-child(4) { width: 15%; }  /* Perihal */
        th:nth-child(5), td:nth-child(5) { width: 8%; }   /* No HP */
        th:nth-child(6), td:nth-child(6) { width: 10%; }  /* Email */
        th:nth-child(7), td:nth-child(7) { width: 12%; }   /* NIK */
        th:nth-child(8), td:nth-child(8) { width: 12%; }   /* No KK */
        th:nth-child(9), td:nth-child(9) { width: 13%; }  /* Alamat */
        th:nth-child(10), td:nth-child(10) { width: 12%; }/* Keterangan */

        tr { page-break-inside: avoid; }
    </style>
</head>
<body>
    <div style="position: absolute; left: 0;">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo" style="height: 60px;">
    </div>
    <div style="text-align: center;">
        <h3 style="text-align: center;">Rekapitulasi Pengajuan Surat Keterangan</h3>
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
                <th>Nama Pemohon</th>
                <th>Perihal</th>
                <th>No HP</th>
                <th>Email</th>
                <th>NIK</th>
                <th>No KK</th>
                <th>Alamat</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suratkets as $index => $surat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $surat->created_at->format('j/n/Y') }}</td>
                    <td>{{ $surat->name }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td>{{ $surat->nohp }}</td>
                    <td>{{ $surat->email }}</td>
                    <td>{{ $surat->nik }}</td>
                    <td>{{ $surat->nokk }}</td>
                    <td>{{ $surat->alamat }}</td>
                    <td>{{ $surat->ket }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align:center;">Tidak ada pengajuan surat pada bulan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>