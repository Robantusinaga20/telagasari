<?php

namespace App\Http\Controllers;

use App\Models\PrktDesa;
use Illuminate\Http\Request;

class PrktDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prktdesas = PrktDesa::orderBy('created_at', 'asc')->get(); // Ambil semua prktdesa
        return view('pages.admin.prktdesa.index', compact('prktdesas')); // Kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prktdesas = PrktDesa::all();
        return view('pages.admin.prktdesa.tambah', compact('prktdesas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'   => 'required|string|max:255',
        'jabatan'     => 'required|string',
        'gambar'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload gambar ke public storage
    $gambarPath = $request->file('gambar')->store('prktdesa', 'public');

    // Simpan ke database
    PrktDesa::create([
        'name'   => $request->name,
        'jabatan'     => $request->jabatan,
        'gambar'  => $gambarPath,
    ]);

    return redirect()->route('prktdesa.index')->with('success', 'data berhasil disimpan.');
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
        $prktdesas= PrktDesa::find($id);
       
       return view('pages.admin.prktdesa.edit',compact('prktdesas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $prktdesas = PrktDesa::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'jabatan'     => 'required|string',
        'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = [
        'name'   => $request->name,
        'jabatan'     => $request->jabatan,
    ];

        // Jika ada gambar baru di-upload
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('prktdesa', 'public');
        $data['gambar'] = $gambarPath;
    }

    $prktdesas->update($data);

    return redirect()->route('prktdesa.index')->with('success', 'data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prktdesas = PrktDesa::find($id);
        $prktdesas->delete();
        
        return redirect()->route('prktdesa.index')->with('success', 'data berhasil dihapus.');
    }
}
