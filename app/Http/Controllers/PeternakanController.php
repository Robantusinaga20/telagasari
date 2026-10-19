<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peternakan;


class PeternakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peternakans = Peternakan::orderBy('created_at', 'asc')->get(); // Ambil semua peternakan
        return view('pages.admin.peternakan.index', compact('peternakans')); // Kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Halaman Tambah perternakanan
        return view('pages.admin.peternakan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'jen_ternak'   => 'required|string',
        'pop_ternak'     => 'required|string',
        'jlh_pemilik'   => 'required|string',
        'gambar'  => 'required|image|mimes:jpg,jpeg,png|max:2048',

    ]);

    // Upload gambar ke public storage
    $gambarPath = $request->file('gambar')->store('peternakan', 'public');

    // Simpan ke database
    Peternakan::create([
        'jen_ternak'   => $request->jen_ternak,
        'pop_ternak'     => $request->pop_ternak,
        'jlh_pemilik'     => $request->jlh_pemilik,
        'gambar'  => $gambarPath,
    ]);

    return redirect()->route('peternakan.index')->with('success', 'data berhasil disimmpan.');
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
        $peternakans= Peternakan::find($id);
       
       return view('pages.admin.peternakan.edit',compact('peternakans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peternakans = Peternakan::findOrFail($id);

        $request->validate([
            'jen_ternak'  => 'required|string',
            'pop_ternak'  => 'required|string',
            'jlh_pemilik'   => 'required|string',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'jen_tanaman'     => $request->jen_tanaman,
            'pop_ternak' => $request->pop_ternak,
            'jlh_pemilik'   => $request->jlh_pemilik,
        ];

        // Jika ada gambar baru di-upload
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('peternakan', 'public');
            $data['gambar'] = $gambarPath;
        }

        $peternakans->update($data);

        return redirect()->route('peternakan.index')->with('success', 'data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peternakans = Peternakan::find($id);
        $peternakans->delete();
        
        return redirect()->route('peternakan.index')->with('success', 'data berhasil dihapus.');
    }
}
