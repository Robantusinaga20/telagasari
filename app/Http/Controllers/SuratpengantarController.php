<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suratpengantar;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class SuratpengantarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya tampilkan surat yang belum diarsipkan
        $suratpengantars = Suratpengantar::where('is_archived', false)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.admin.suratpengantar.index', compact('suratpengantars'));
    }

    public function check($id)
    {
        $surat = Suratpengantar::findOrFail($id);
        $surat->status = 'Dikonfirmasi';
        $surat->save();

        return redirect()->route('suratpengantar.index')->with('success', 'Surat telah ditandai sebagai dikonfirmasi.');
    }

    public function arsipkan($id)
    {
        $surat = Suratpengantar::findOrFail($id);

        // Tandai surat sebagai arsip
        $surat->is_archived = true;
        $surat->save();

        return redirect()->route('suratpengantar.index')->with('success', 'Surat berhasil diarsipkan.');
    }

    public function arsip()
    {
        // Ambil semua surat yang sudah diarsipkan
        $arsipSurat = Suratpengantar::where('is_archived', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.suratpengantar.arsip', compact('arsipSurat'));
    }
    public function keluarkanArsip($id)
    {
        $surat = Suratpengantar::findOrFail($id);

        // Ubah status arsip kembali ke false (keluar dari arsip)
        $surat->is_archived = false;
        $surat->save();

        return redirect()->route('suratpengantar.arsip')->with('success', 'Surat berhasil dikeluarkan dari arsip.');
    }

    public function downloadPage()
    {
        // Ambil daftar jenis surat (distinct)
        $jenisSurat = Suratpengantar::select('jen_surat')->distinct()->pluck('jen_surat');
        return view('pages.admin.suratpengantar.download', compact('jenisSurat'));
    }

    public function downloadPDF(Request $request)
    {
        $request->validate([
            'periode' => 'required|date_format:Y-m',
            'jen_surat' => 'required|string'
        ]);

        $periode = $request->periode;
        $bulan = date('m', strtotime($periode));
        $tahun = date('Y', strtotime($periode));
        $jenSurat = $request->jen_surat;

        // Ambil data sesuai filter
        $suratpengantars = Suratpengantar::where('status', 'Dikonfirmasi')
            ->where('jen_surat', $jenSurat)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        // Generate PDF
        $pdf = Pdf::loadView('pages.admin.suratpengantar.pdf', compact('suratpengantars', 'bulan', 'tahun', 'jenSurat'));
        return $pdf->download("Rekap-Suratpengantarerangan-{$jenSurat}-{$bulan}-{$tahun}.pdf");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'jen_surat'=> 'required|string|max:50',
            'perihal'  => 'required|string|max:50',
            'nohp'     => 'required|string|max:20',
            'email'    => 'required|email|max:50',
            'name'     => 'required|string|max:50',
            'jen_kel'   => 'required|string|max:15',
            'tplahir'    => 'required|string|max:50',
            'tglahir' => 'required|date',
            'agama'    => 'required|string|max:25',
            'stat'     => 'required|string|max:30',
            'pkerja'     => 'required|string|max:30',
            'alamat'   => 'required|string|max:50',
        ]);

        $nohp = '+62' . ltrim($request->nohp, '0'); // pastikan tidak ada 0 di awal

         $suratpengantars = Suratpengantar::create([
            'jen_surat'  => $request->jen_surat,
            'perihal'    => $request->perihal,
            'nohp' => $nohp,
            'email'      => $request->email,
            'name'       => $request->name,
            'jen_kel'        => $request->jen_kel,
            'tplahir'       => $request->tplahir,
            'tglahir'        => $request->tglahir,
            'agama'        => $request->agama,
            'stat'       => $request->stat,
            'pkerja'        => $request->pkerja,
            'alamat'     => $request->alamat,
            'status'     => 'Diproses',
        ]);

        return redirect()->route('suratpengantar.konfirm_peng', $suratpengantars->id);
    }
    public function konfirmasi($id)
    {
        $suratpengantars = Suratpengantar::findOrFail($id);
        return view('pages.layanan.konfirm_peng', compact('suratpengantars'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suratpengantar = Suratpengantar::findOrFail($id);
        return view('pages.admin.suratpengantar.show', compact('suratpengantar'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suratpengantars = Suratpengantar::findOrFail($id);
        $suratpengantars->delete();
        
        return redirect()->route('suratpengantar.index')->with('success', 'Surat berhasil dihapus.');
    }
}
