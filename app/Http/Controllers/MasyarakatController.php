<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suratket;
use App\Models\Suratpengantar;
use App\Models\Suratpengadu;
use Barryvdh\DomPDF\Facade\Pdf;

class MasyarakatController extends Controller
{
    public function index()
    {
        // Ambil daftar jenis surat dari dua tabel yg memang punya field jen_surat
        $jenisSuratKet = Suratket::select('jen_surat')->distinct()->pluck('jen_surat');
        $jenisSuratPengantar = Suratpengantar::select('jen_surat')->distinct()->pluck('jen_surat');

        // Tambahkan manual satu opsi 'Pengaduan' untuk mewakili tabel suratpengadu
        $jenisSurat = $jenisSuratKet
            ->merge($jenisSuratPengantar)
            ->push('Pengaduan') // hanya sekali masuk
            ->unique();         // buang duplikat kalau ada

        return view('pages.layanan.masyarakat', compact('jenisSurat'));
    }

    public function fsuratket()
    {
        return view('pages.layanan.fsuratket');
    }

    public function fsuratpengantar()
    {
        return view('pages.layanan.fsuratpengantar');
    }
    public function fsuratpengadu()
    {
        return view('pages.layanan.fsuratpengadu');
    }
    public function fsuratkritsar()
    {
        return view('pages.layanan.fsuratkritsar');
    }
    
    public function cariSurat(Request $request)
    {
        $id = $request->get('id');
        $jenSurat = $request->get('jen_surat');

        if (!$id || !$jenSurat) {
            return response()->json(['error' => 'Nomor surat dan jenis surat wajib diisi.'], 400);
        }

        $surat = null;

        if ($jenSurat === 'Pengaduan') {
            // Cari di tabel suratpengadu
            $surat = Suratpengadu::where('id', $id)->first();

            if (!$surat) {
                return response()->json(['error' => 'Surat Pengaduan tidak ditemukan.']);
            }

            return response()->json([
                'id' => $surat->id,
                'created_at' => $surat->created_at,
                'name' => $surat->name ?? '-',
                'jen_surat' => 'Pengaduan', // default label
                'perihal' => $surat->perihal ?? '-',
                'status' => $surat->status ?? 'Pending'
            ]);
        }

        // Cari di SuratKet
        $surat = SuratKet::where('id', $id)->where('jen_surat', $jenSurat)->first();

        // Kalau tidak ketemu, cari di Suratpengantar
        if (!$surat) {
            $surat = Suratpengantar::where('id', $id)->where('jen_surat', $jenSurat)->first();
        }

        if (!$surat) {
            return response()->json(['error' => 'Surat tidak ditemukan.']);
        }

        return response()->json([
            'id' => $surat->id,
            'created_at' => $surat->created_at,
            'name' => $surat->name ?? '-',
            'jen_surat' => $surat->jen_surat,
            'status' => $surat->status ?? 'Pending',
            'tipe' => ($surat instanceof SuratKet) ? 'suratket' :
                    (($surat instanceof SuratPengantar) ? 'suratpengantar' : 'lain')
        ]);
    }

        public function download($tipe, $id)
        {
            if ($tipe === 'suratket') {
                $surat = SuratKet::findOrFail($id);
            } elseif ($tipe === 'suratpengantar') {
                $surat = SuratPengantar::findOrFail($id);
            } else {
                abort(404, 'Jenis surat tidak ditemukan.');
            }

            // Pilih view template sesuai jenis surat
            $view = $tipe === 'suratket' ? 'pages.layanan.download_ket' : 'pages.layanan.download_peng';

            $pdf = Pdf::loadView($view, compact('surat'));

            $filename = ucfirst($tipe) . '_' . $surat->id . '.pdf';
            return $pdf->download($filename);
        }
}
