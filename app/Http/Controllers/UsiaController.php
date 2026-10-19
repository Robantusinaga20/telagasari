<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usia;


class UsiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usias = Usia::orderBy('created_at', 'asc')->get();
        return view('pages.admin.usia.index', compact('usias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.usia.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'usia' => 'required|string',
            'jlh_lk'   => 'required|integer|min:1',
            'jlh_pr'   => 'required|integer|min:0',
        ]);

        Usia::create($request->only(['usia', 'jlh_lk', 'jlh_pr']));

        return redirect()->route('usia.index')->with('success', 'Data berhasil disimpan.');
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
        $usias = Usia::findOrFail($id);
        return view('pages.admin.usia.edit', compact('usias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usias = Usia::findOrFail($id);

        $request->validate([
            'usia'=> 'required|string',
            'jlh_lk'   => 'required|integer|min:0',
            'jlh_pr'   => 'required|integer|min:0',
        ]);

        $usias->update([
            'usia'   => $request->usia,
            'jlh_lk' => $request->jlh_lk,
            'jlh_pr' => $request->jlh_pr,
        ]);

        return redirect()->route('usia.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usias = Usia::findOrFail($id);
        $usias->delete();

        return redirect()->route('usia.index')->with('success', 'data berhasil dihapus.');
    }
}
