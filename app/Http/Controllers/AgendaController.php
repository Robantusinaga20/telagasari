<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Agenda::orderBy('created_at', 'asc')->get(); // Ambil semua agenda
        return view('pages.admin.agenda.index', compact('agendas')); // Kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Halaman Tambah Artikel
        return view('pages.admin.agenda.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'   => 'required|unique:agendas,name|max:255',
        'tanggal' => 'required|date',
        'gambar'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload gambar ke public storage
    $gambarPath = $request->file('gambar')->store('agenda', 'public');

    // Simpan ke database
    Agenda::create([
        'name'   => $request->name,
        'tanggal' => $request->tanggal,
        'gambar'  => $gambarPath,
    ]);
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil disimpan.');
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
        $agendas= Agenda::find($id);
       
       return view('pages.admin.agenda.edit',compact('agendas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $agendas = Agenda::findOrFail($id);

    $request->validate([
        'name'   => 'required|unique:agendas,name,' . $agendas->id,
        'tanggal' => 'required|date',
        'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = [
        'name'   => $request->name,
        'tanggal' => $request->tanggal,
    ];

    // Jika ada gambar baru di-upload
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('agenda', 'public');
        $data['gambar'] = $gambarPath;
    }

    $agendas->update($data);

    return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agendas = Agenda::find($id);
        $agendas->delete();
        
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
