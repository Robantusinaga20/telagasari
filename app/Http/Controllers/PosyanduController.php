<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\Galeri;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posyandus = Posyandu::orderBy('created_at', 'asc')->get(); // Ambil semua posyandu
        return view('pages.admin.posyandu.index', compact('posyandus')); // Kirim ke view
    }

    public function kesehatan()
    {
        // Ambil data posyandu saja
        $galeriPosyandu = Galeri::where('kategori', 'posyandu')->get();

        $posyanduBalita = Posyandu::where('kategori', 'balita')->get();
        $posyanduIbu = Posyandu::where('kategori', 'ibu hamil')->get();
        $posyanduLansia = Posyandu::where('kategori', 'lansia')->get();
        return view('pages.layanan.kesehatan', compact('posyanduBalita', 'posyanduIbu', 'posyanduLansia', 'galeriPosyandu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.posyandu.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'   => 'required|string|max:255',
        'kategori'     => 'required|string',
        'tanggal'     => 'required|integer',
        'alamat'     => 'required|string',
    ]);

    // Simpan ke database
    Posyandu::create([
        'name'   => $request->name,
        'kategori'     => $request->kategori,
        'tanggal'     => $request->tanggal,
        'alamat'     => $request->alamat,
    ]);

    return redirect()->route('posyandu.index')->with('success', 'data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posyandus= Posyandu::find($id);
       
       return view('pages.admin.posyandu.edit',compact('posyandus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $posyandus = Posyandu::findOrFail($id);

    $request->validate([
        'name'   => 'required|string|max:255',
        'kategori'     => 'required|string',
        'tanggal' => 'required|integer',
        'alamat'     => 'required|string',
    ]);

    $data = [
        'name'   => $request->name,
        'kategori'     => $request->kategori,
        'tanggal'     => $request->tanggal,
        'alamat'     => $request->alamat,
    ];

    $posyandus->update($data);

    return redirect()->route('posyandu.index')->with('success', 'posyandu berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posyandus = Posyandu::find($id);
        $posyandus->delete();
        
        return redirect()->route('posyandu.index')->with('success', 'posyandu berhasil dihapus.');
    }
}
