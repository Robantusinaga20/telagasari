<?php

namespace App\Http\Controllers;

use App\Models\Kritsar;
use Illuminate\Http\Request;

class KritsarController extends Controller
{
    public function index()
    {        
        $kritsars = Kritsar::orderBy('created_at', 'asc')->get();
        return view('pages.admin.kritsar.index', compact('kritsars'));
    }

    public function show(string $id)
    {
        $kritsar = Kritsar::findOrFail($id);
        return view('pages.admin.kritsar.show', compact('kritsar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kritik'   => 'required|string|max:255',
            'saran'    => 'required|string|max:255',
        ]);

        // Simpan ke database
        Kritsar::create([
            'kritik'=> $request->kritik,
            'saran' => $request->saran,
        ]);
        return redirect()->route('fkritsar')->with('success', 'Terimakasih! Kritik dan Saran anda berhasil dikirim!.');
    }

    public function destroy(string $id)
    {
        $kritsars = Kritsar::find($id);
        $kritsars->delete();
        
        return redirect()->route('kritsar.index')->with('success', 'Kritik & Saran berhasil dihapus.');
    }
}
