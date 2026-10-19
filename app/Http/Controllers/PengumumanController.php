<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumumans = Pengumuman::orderBy('created_at', 'asc')->get(); // Ambil semua pengumuman
        return view('pages.admin.pengumuman.index', compact('pengumumans')); // Kirim ke view
    }

    public function pengumuman()
    {
        $pengumumans = Pengumuman::all();
        return view('pages.berita.pengumuman', compact('pengumumans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Halaman Tambah pengumuman
        return view('pages.admin.pengumuman.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|unique:pengumumans,judul|max:255',
            'kategori' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'isi'     => 'required|string',
        ]);

        // Simpan ke database
        Pengumuman::create([
            'judul'   => $request->judul,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'isi'     => $request->isi,
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'pengumuman berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('pages.admin.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengumumans= Pengumuman::find($id);
       
       return view('pages.admin.pengumuman.edit',compact('pengumumans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengumumans = Pengumuman::findOrFail($id);

        $request->validate([
            'judul'   => 'required|unique:pengumumans,judul,' . $pengumumans->id,
            'kategori'=> 'required|string|max:255',
            'tanggal' => 'required|date',
            'isi'     => 'required|string',
        ]);

        $data = [
            'judul'   => $request->judul,
            'kategori'=> $request->kategori,
            'tanggal' => $request->tanggal,
            'isi'     => $request->isi,
        ];

        $pengumumans->update($data);

        return redirect()->route('pengumuman.index')->with('success', 'pengumuman berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengumumans = Pengumuman::find($id);
        $pengumumans->delete();
        
        return redirect()->route('pengumuman.index')->with('success', 'pengumuman berhasil dihapus.');
    }
}