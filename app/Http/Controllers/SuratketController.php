<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suratket;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SuratketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya tampilkan surat yang belum diarsipkan
        $suratkets = SuratKet::where('is_archived', false)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.admin.suratket.index', compact('suratkets'));
    }

    public function check($id)
    {
        $surat = SuratKet::findOrFail($id);
        $surat->status = 'Dikonfirmasi';
        $surat->save();

        return redirect()->route('suratket.index')->with('success', 'Surat telah ditandai sebagai dikonfirmmasi.');
    }

    public function arsipkan($id)
    {
        $surat = SuratKet::findOrFail($id);

        // Tandai surat sebagai arsip
        $surat->is_archived = true;
        $surat->save();

        return redirect()->route('suratket.index')->with('success', 'Surat berhasil diarsipkan.');
    }

    public function arsip()
    {
        // Ambil semua surat yang sudah diarsipkan
        $arsipSurat = SuratKet::where('is_archived', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.suratket.arsip', compact('arsipSurat'));
    }

    public function keluarkanArsip($id)
    {
        $surat = SuratKet::findOrFail($id);

        // Ubah status arsip kembali ke false (keluar dari arsip)
        $surat->is_archived = false;
        $surat->save();

        return redirect()->route('suratket.arsip')->with('success', 'Surat berhasil dikeluarkan dari arsip.');
    }

    public function downloadPage()
    {
        // Ambil daftar jenis surat (distinct)
        $jenisSurat = SuratKet::select('jen_surat')->distinct()->pluck('jen_surat');
        return view('pages.admin.suratket.download', compact('jenisSurat'));
    }

    public function downloadPDF(Request $request)
    {
        $request->validate([
            'periode'   => 'required|date_format:Y-m',
            'jen_surat' => 'required|string'
        ]);

        $periode  = $request->periode;
        $bulan    = date('m', strtotime($periode));
        $tahun    = date('Y', strtotime($periode));
        $jenSurat = $request->jen_surat;

        // Ambil data sesuai filter
        $suratkets = SuratKet::where('status', 'Dikonfirmasi')
            ->where('jen_surat', $jenSurat)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        // === Pastikan folder temp ada ===
        $tempPath = storage_path('app/temp');
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        // === Generate PDF dulu ===
        $pdf     = Pdf::loadView('pages.admin.suratket.pdf', compact('suratkets', 'bulan', 'tahun', 'jenSurat'));
        $pdfName = "Rekap-SuratKeterangan-{$jenSurat}-{$bulan}-{$tahun}.pdf";
        $pdfPath = "{$tempPath}/{$pdfName}";
        $pdf->save($pdfPath);

        // === Kalau user centang checkbox gambar → buat ZIP ===
        if ($request->has('download_images')) {
            $zipName = "Rekap-SuratKeterangan-{$jenSurat}-{$bulan}-{$tahun}.zip";
            $zipPath = "{$tempPath}/{$zipName}";

            $zip = new \ZipArchive();
            if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {

                // Tambahkan PDF ke dalam ZIP
                $zip->addFile($pdfPath, $pdfName);

                // Tambahkan semua gambar dari surat
                foreach ($suratkets as $surat) {
                    if ($surat->gambar) {
                        $images = json_decode($surat->gambar, true);
                        if (!is_array($images)) {
                            $images = [$surat->gambar]; // handle kalau hanya 1 gambar
                        }

                        foreach ($images as $index => $img) {
                            $filePath = storage_path("app/public/" . $img);
                            if (file_exists($filePath)) {
                                $ext = pathinfo($filePath, PATHINFO_EXTENSION);
                                $zip->addFile($filePath, $surat->name . "-" . ($index + 1) . "." . $ext);
                            }
                        }
                    }
                }

                $zip->close();
            }

            // PDF sementara tetap ikut dihapus setelah kirim ZIP
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }

            // Kirim ZIP → otomatis hapus setelah terkirim
            return response()->download($zipPath, $zipName, [
                'Content-Type' => 'application/zip',
            ])->deleteFileAfterSend(true);
        }

        // === Kalau checkbox tidak dicentang → hanya PDF ===
        return response()->download($pdfPath, $pdfName, [
            'Content-Type' => 'application/pdf',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'jen_surat'=> 'required|string|max:50',
            'nohp'     => 'required|string|max:20',
            'email'    => 'required|email|max:50',
            'nik'      => 'required|string|size:16',
            'nokk'     => 'required|string|size:16',
            'gambar.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'name'     => 'required|string|max:50',
            'alamat'   => 'required|string|max:50',
            'perihal'  => 'required|string|max:50',
            'ket'      => 'nullable|string',
        ]);

        $nohp = '+62' . ltrim($request->nohp, '0'); // pastikan tidak ada 0 di awal
        // Upload gambar ke public storage
        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('suratket', 'public');
            }
        }

         $suratkets = SuratKet::create([
            'jen_surat'  => $request->jen_surat,
            'nohp' => $nohp,
            'email'      => $request->email,
            'nik'        => $request->nik,
            'nokk'       => $request->nokk,
            'gambar'     => json_encode($gambarPaths),
            'name'       => $request->name,
            'alamat'     => $request->alamat,
            'perihal'    => $request->perihal,
            'ket'        => $request->ket,
            'status'     => 'Diproses',
        ]);

        return redirect()->route('suratket.konfirm_ket', $suratkets->id);
    }

    public function konfirmasi($id)
    {
        $suratkets = Suratket::findOrFail($id);
        return view('pages.layanan.konfirm_ket', compact('suratkets'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suratket = Suratket::findOrFail($id);
        return view('pages.admin.suratket.show', compact('suratket'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suratkets = Suratket::find($id);
        $suratkets->delete();
        
        return redirect()->route('suratket.index')->with('success', 'Surat berhasil dihapus.');
    }
}
