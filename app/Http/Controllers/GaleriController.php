<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::orderBy('created_at', 'asc')->get(); 
        return view('pages.admin.galeri.index', compact('galeris')); 
    }

    public function galeri()
    {
        $galeris = Galeri::all();
        return view('pages.galeri', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.galeri.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar.*'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal'    => 'required|date',
            'ket'        => 'required|string',
            'kategori'   => 'required|string|max:255',
        ]);

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('galeri', 'public');
            }
        }

        Galeri::create([
            'gambar'    => json_encode($gambarPaths), // simpan dalam array JSON
            'tanggal'   => $request->tanggal,
            'ket'       => $request->ket,
            'kategori'  => $request->kategori,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Gambar berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galeris= Galeri::findOrFail($id);
        return view('pages.admin.galeri.edit', compact('galeris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'gambar.*'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal'    => 'required|date',
            'ket'        => 'required|string',
            'kategori'   => 'required|string|max:255',
        ]);

        $data = [
            'tanggal'   => $request->tanggal,
            'ket'       => $request->ket,
            'kategori'  => $request->kategori,
        ];

        // 🔹 Ambil gambar lama
        $gambarLama = $galeri->gambar ? json_decode($galeri->gambar, true) : [];

        // 🔹 Hapus gambar lama jika dipilih di form
        if ($request->filled('hapus_gambar')) {
            foreach ($request->hapus_gambar as $hapus) {
                if (($key = array_search($hapus, $gambarLama)) !== false) {
                    unset($gambarLama[$key]);
                    \Storage::delete('public/' . $hapus); // hapus dari storage
                }
            }
            $gambarLama = array_values($gambarLama); // reset index array
        }

        // 🔹 Upload gambar baru
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('galeri', 'public');
                $gambarLama[] = $path;
            }
        }

        $data['gambar'] = json_encode($gambarLama);

        $galeri->update($data);

        return redirect()->route('galeri.index')->with('success', 'Gambar berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galeri = Galeri::findOrFail($id);

        // hapus semua file gambar di storage
        if ($galeri->gambar) {
            foreach (json_decode($galeri->gambar, true) as $gambar) {
                Storage::disk('public')->delete($gambar);
            }
        }

        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Gambar berhasil dihapus.');
    }
}