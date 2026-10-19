<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduks = Penduduk::orderBy('created_at', 'asc')->get();
        $totalPenduduk = $penduduks->sum('jlh_penduduk');
        $totalKeluarga = $penduduks->sum('jlh_keluarga');
        return view('pages.admin.penduduk.index', compact('penduduks', 'totalPenduduk', 'totalKeluarga'));
    }

    public function create()
    {
        return view('pages.admin.penduduk.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dusun'          => 'required|unique:penduduks,dusun|max:255',
            'jlh_penduduk'   => 'required|integer|min:1',
            'jlh_keluarga'   => 'required|integer|min:1',
        ]);

        Penduduk::create($request->only(['dusun', 'jlh_penduduk', 'jlh_keluarga']));

        return redirect()->route('penduduk.index')->with('success', 'Data berhasil disimpan.');
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
        $penduduks = Penduduk::findOrFail($id);
        return view('pages.admin.penduduk.edit', compact('penduduks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penduduks = Penduduk::findOrFail($id);

        $request->validate([
            'dusun'          => 'required|max:255|unique:penduduks,dusun,' . $penduduks->id,
            'jlh_penduduk'   => 'required|integer|min:1',
            'jlh_keluarga'   => 'required|integer|min:1',
        ]);

        $penduduks->update([
            'dusun'          => $request->dusun,
            'jlh_penduduk'   => $request->jlh_penduduk,
            'jlh_keluarga'   => $request->jlh_keluarga,
        ]);

        return redirect()->route('penduduk.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penduduks = Penduduk::findOrFail($id);
        $penduduks->delete();

        return redirect()->route('penduduk.index')->with('success', 'data berhasil dihapus.');
    }
}
