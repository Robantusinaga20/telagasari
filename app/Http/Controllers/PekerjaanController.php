<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekerjaan;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pekerjaans = Pekerjaan::orderBy('created_at', 'asc')->get();
        return view('pages.admin.pekerjaan.index', compact('pekerjaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.pekerjaan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jen_kerja' => 'required|unique:pekerjaans,jen_kerja|max:255',
            'jlh_lk'   => 'required|integer|min:1',
            'jlh_pr'   => 'required|integer|min:0',
        ]);

        Pekerjaan::create($request->only(['jen_kerja', 'jlh_lk', 'jlh_pr']));

        return redirect()->route('pekerjaan.index')->with('success', 'Data berhasil disimpan.');
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
        $pekerjaans = Pekerjaan::findOrFail($id);
        return view('pages.admin.pekerjaan.edit', compact('pekerjaans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pekerjaans = Pekerjaan::findOrFail($id);

        $request->validate([
            'jen_kerja'=> 'required|max:255|unique:pekerjaans,jen_kerja,' . $pekerjaans->id,
            'jlh_lk'   => 'required|integer|min:1',
            'jlh_pr'   => 'required|integer|min:0',
        ]);

        $pekerjaans->update([
            'jen_kerja'=> $request->jen_kerja,
            'jlh_lk'   => $request->jlh_lk,
            'jlh_pr'   => $request->jlh_pr,
        ]);

        return redirect()->route('pekerjaan.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $pekerjaans = Pekerjaan::findOrFail($id);
        $pekerjaans->delete();

        return redirect()->route('pekerjaan.index')->with('success', 'data berhasil dihapus.');
    }
    
}
