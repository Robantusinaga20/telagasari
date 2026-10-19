<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suratpengadu;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SuratpengaduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya tampilkan surat yang belum diarsipkan
        $suratpengadus = Suratpengadu::where('is_archived', false)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.admin.suratpengadu.index', compact('suratpengadus'));
    }

    public function check($id)
    {
        $surat = Suratpengadu::findOrFail($id);
        $surat->status = 'Dikonfirmasi';
        $surat->save();

        return redirect()->route('suratpengadu.index')->with('success', 'Surat telah ditandai sebagai dikonfirmmasi.');
    }

    public function arsipkan($id)
    {
        $surat = Suratpengadu::findOrFail($id);

        // Tandai surat sebagai arsip
        $surat->is_archived = true;
        $surat->save();

        return redirect()->route('suratpengadu.index')->with('success', 'Surat berhasil diarsipkan.');
    }

    public function arsip()
    {
        // Ambil semua surat yang sudah diarsipkan
        $arsipSurat = Suratpengadu::where('is_archived', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.suratpengadu.arsip', compact('arsipSurat'));
    }

    public function keluarkanArsip($id)
    {
        $surat = Suratpengadu::findOrFail($id);

        // Ubah status arsip kembali ke false (keluar dari arsip)
        $surat->is_archived = false;
        $surat->save();

        return redirect()->route('suratpengadu.arsip')->with('success', 'Surat berhasil dikeluarkan dari arsip.');
    }

    public function downloadPage()
    {
        // Ambil daftar jenis surat (distinct)
        return view('pages.admin.suratpengadu.download');
    }

    public function downloadPDF(Request $request)
    {
        $request->validate([
            'periode'   => 'required|date_format:Y-m',
        ]);

        $periode  = $request->periode;
        $bulan    = date('m', strtotime($periode));
        $tahun    = date('Y', strtotime($periode));

        // Ambil data sesuai filter
        $suratpengadus = Suratpengadu::where('status', 'Dikonfirmasi')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        // === Pastikan folder temp ada ===
        $tempPath = storage_path('app/temp');
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        // === Generate PDF dulu ===
        $pdf     = Pdf::loadView('pages.admin.suratpengadu.pdf', compact('suratpengadus', 'bulan', 'tahun',));
        $pdfName = "Rekap-Suratpengaduan-{$bulan}-{$tahun}.pdf";
        $pdfPath = "{$tempPath}/{$pdfName}";
        $pdf->save($pdfPath);

        // === Kalau user centang checkbox gambar → buat ZIP ===
        if ($request->has('download_images')) {
            $zipName = "Rekap-Suratpengaduan-{$bulan}-{$tahun}.zip";
            $zipPath = "{$tempPath}/{$zipName}";

            $zip = new \ZipArchive();
            if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {

                // Tambahkan PDF ke dalam ZIP
                $zip->addFile($pdfPath, $pdfName);

                // Tambahkan semua gambar dari surat
                foreach ($suratpengadus as $surat) {
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
            'nohp'     => 'required|string|max:20',
            'gambar.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'name'     => 'required|string|max:50',
            'alamat'   => 'required|string|max:50',
            'lokasi'   => 'required|string|max:50',
            'perihal'  => 'required|string|max:50',
            'deskripsi'=> 'nullable|string',
        ]);

        $nohp = '+62' . ltrim($request->nohp, '0'); // pastikan tidak ada 0 di awal
        // Upload gambar ke public storage
        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('agenda', 'public');
            }
        }

         $suratpengadus = Suratpengadu::create([
            'nohp' => $nohp,
            'gambar'     => json_encode($gambarPaths),
            'name'       => $request->name,
            'alamat'     => $request->alamat,
            'lokasi'     => $request->lokasi,
            'perihal'    => $request->perihal,
            'deskripsi'  => $request->deskripsi,
            'status'     => 'Diproses',
        ]);

        return redirect()->route('suratpengadu.konfirm_pengadu', $suratpengadus->id);
    }

    public function konfirmasi($id)
    {
        $suratpengadus = Suratpengadu::findOrFail($id);
        return view('pages.layanan.konfirm_pengadu', compact('suratpengadus'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suratpengadu = Suratpengadu::findOrFail($id);
        return view('pages.admin.suratpengadu.show', compact('suratpengadu'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suratpengadus = Suratpengadu::find($id);
        $suratpengadus->delete();
        
        return redirect()->route('suratpengadu.index')->with('success', 'Surat berhasil dihapus.');
    }
}