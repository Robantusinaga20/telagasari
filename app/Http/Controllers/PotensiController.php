<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peternakan;
use App\Models\Perkebunan;
use App\Models\Galeri;

class PotensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function potensi()
    {
        // Ambil galeri dengan kategori yang mengandung kata 'peternakan' atau 'perkebunan'
        $galeriPotensi = Galeri::where(function ($query) {
                $query->where('kategori', 'like', '%peternakan%')
                      ->orWhere('kategori', 'like', '%perkebunan%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil data peternakan & perkebunan
        $peternakans = Peternakan::orderBy('id')->get();
        $perkebunans = Perkebunan::orderBy('id')->get();

        // Kirim ke view
        return view('pages.potensi', compact('peternakans', 'perkebunans', 'galeriPotensi'));
    }
}