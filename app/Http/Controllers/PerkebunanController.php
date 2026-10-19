<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perkebunan;

class PerkebunanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perkebunans = Perkebunan::orderBy('created_at', 'asc')->get(); // Ambil semua perkebunan
        return view('pages.admin.perkebunan.index', compact('perkebunans')); // Kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Halaman Tambah perkebunan
        return view('pages.admin.perkebunan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
         'jen_tanaman'   => 'required|string',
        'luas'   => 'required|string',
        'jlh_panen'   => 'required|string',
        'gambar'  => 'required|image|mimes:jpg,jpeg,png|max:2048',

    ]);

        // Upload gambar ke public storage
        $gambarPath = $request->file('gambar')->store('perkebunan', 'public');

    // Simpan ke database
    Perkebunan::create([
        'jen_tanaman'   => $request->jen_tanaman,
        'luas'   => $request->luas,
        'jlh_panen'     => $request->jlh_panen,
        'gambar'  => $gambarPath,
    ]);

    return redirect()->route('perkebunan.index')->with('success', 'data berhasil disimmpan.');
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
        $perkebunans= Perkebunan::find($id);
       
       return view('pages.admin.perkebunan.edit',compact('perkebunans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perkebunans = Perkebunan::findOrFail($id);

        $request->validate([
            'jen_tanaman'  => 'required|string',
            'luas'  => 'required|string',
            'jlh_panen'   => 'required|string',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'jen_tanaman'     => $request->jen_tanaman,
            'luas'   => $request->luas,
            'jlh_panen'   => $request->jlh_panen,
        ];

        // Jika ada gambar baru di-upload
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('perkebunan', 'public');
            $data['gambar'] = $gambarPath;
        }

        $perkebunans->update($data);

        return redirect()->route('perkebunan.index')->with('success', 'data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perkebunans = Perkebunan::find($id);
        $perkebunans->delete();
        
        return redirect()->route('perkebunan.index')->with('success', 'data berhasil dihapus.');
    }
}
