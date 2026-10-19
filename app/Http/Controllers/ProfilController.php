<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Pekerjaan;
use App\Models\Usia;
use App\Models\PrktDesa;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function index()
    {
        return view('pages.profil.index');
    }
public function struktur()
{
    // Ambil semua perangkat desa
    $prktdesas = PrktDesa::all();

    $kepalaDesa = PrktDesa::where(DB::raw('LOWER(jabatan)'), 'like', '%kepala desa%')->first();
    $sekretaris = PrktDesa::where(DB::raw('LOWER(jabatan)'), 'like', '%sekretaris%')->first();
    $kaur = PrktDesa::where('jabatan', 'like', '%kaur%')->get();
    $kasi = PrktDesa::where('jabatan', 'like', '%kasi%')->get();
    $dusun = PrktDesa::where('jabatan', 'like', '%dusun%')->get();

    return view('pages.profil.struktur', compact('prktdesas', 'kepalaDesa', 'sekretaris', 'kaur', 'kasi', 'dusun',));
}
    public function penduduk()
    {
        $penduduks = Penduduk::orderBy('created_at', 'asc')->get();
        $totalPenduduk = $penduduks->sum('jlh_penduduk');
        $totalKeluarga = $penduduks->sum('jlh_keluarga');

        // Data Penduduk per Dusun
        $labels = $penduduks->pluck('dusun')->toArray();
        $jumlahPenduduk = $penduduks->pluck('jlh_penduduk')->toArray();
        $jumlahKeluarga = $penduduks->pluck('jlh_keluarga')->toArray();

        // Data Pekerjaan (pakai variabel khusus)
        $pekerjaan = Pekerjaan::all();
        $labelsPekerjaan = $pekerjaan->pluck('jen_kerja')->toArray();
        $jumlahKerjaLk = $pekerjaan->pluck('jlh_lk')->toArray();
        $jumlahKerjaPr = $pekerjaan->pluck('jlh_pr')->toArray();

        // Data Usia (pakai variabel khusus)
        $usia = Usia::all();
        $labelsUsia = $usia->pluck('usia')->toArray();
        $jumlahUsiaLk = $usia->pluck('jlh_lk')->toArray();
        $jumlahUsiaPr = $usia->pluck('jlh_pr')->toArray();

        return view('pages.profil.penduduk', compact(
            'labels',
            'jumlahPenduduk',
            'jumlahKeluarga',
            'totalPenduduk',
            'totalKeluarga',
            'labelsPekerjaan',
            'jumlahKerjaLk',
            'jumlahKerjaPr',
            'labelsUsia',
            'jumlahUsiaLk',
            'jumlahUsiaPr'
        ));
    }

}
