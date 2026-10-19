<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::orderBy('created_at', 'asc')->get(); // Ambil semua artikel
        return view('pages.admin.artikel.index', compact('artikels')); // Kirim ke view
    }

    public function artikel()
    {
        $artikels = Artikel::all();
        return view('pages.berita.artikel', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Halaman Tambah Artikel
        return view('pages.admin.artikel.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'judul'   => 'required|unique:artikels,judul|max:255',
        'tanggal' => 'required|date',
        'isi'     => 'required|string',
        'gambar'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload gambar ke public storage
    $gambarPath = $request->file('gambar')->store('artikel', 'public');

    // Simpan ke database
    Artikel::create([
        'judul'   => $request->judul,
        'tanggal' => $request->tanggal,
        'isi'     => $request->isi,
        'gambar'  => $gambarPath,
    ]);

    return redirect()->route('artikel.index')->with('success', 'Artikel berhasil disimpan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('pages.admin.artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikels= Artikel::find($id);
       
       return view('pages.admin.artikel.edit',compact('artikels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $artikels = Artikel::findOrFail($id);

    $request->validate([
        'judul'   => 'required|unique:artikels,judul,' . $artikels->id,
        'tanggal' => 'required|date',
        'isi'     => 'required|string',
        'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = [
        'judul'   => $request->judul,
        'tanggal' => $request->tanggal,
        'isi'     => $request->isi,
    ];

    // Jika ada gambar baru di-upload
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('artikel', 'public');
        $data['gambar'] = $gambarPath;
    }

    $artikels->update($data);

    return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diubah.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artikels = Artikel::find($id);
        $artikels->delete();
        
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}