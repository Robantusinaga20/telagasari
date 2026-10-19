<?php

namespace App\Http\Controllers;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Agenda;
use App\Models\Penduduk;
use App\Models\PrktDesa;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        public function index(Request $request)
    {
        $artikels = Artikel::latest()->take(5)->get();
        $galeris = Galeri::latest()->take(15)->get();
        $agendas  = Agenda::latest()->take(5)->get(); 
        $prktdesas = PrktDesa::all();
        $penduduks = Penduduk::all();
        $totalPenduduk = $penduduks->sum('jlh_penduduk');
        $totalKeluarga = $penduduks->sum('jlh_keluarga');
        $kepalaDesa = PrktDesa::where(DB::raw('LOWER(jabatan)'), 'like', '%kepala desa%')->first();

        $ip = getRealIp($request);

        // Cek apakah IP ini sudah tercatat hari ini
        $alreadyVisited = Visitor::where('ip_address', $ip)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if (!$alreadyVisited) {
            Visitor::create(['ip_address' => $ip]);
        }

        $totalVisitors = Visitor::count();

        return view('pages.home', compact('artikels', 'galeris', 'agendas', 'kepalaDesa', 'penduduks', 'totalPenduduk', 'totalKeluarga', 'totalVisitors',));
    }

        public function agenda()
    {
        $agendas  = Agenda::latest()->take(5)->get(); 
        return view('pages.berita.agenda', compact('agendas'));
    }

    public function prog()
    {
        return view('pages.prog.index');
    }
}
