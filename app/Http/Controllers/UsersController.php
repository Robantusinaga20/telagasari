<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->get();
        return view('pages.admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.admin.user.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|unique:users,name|max:255',
            'username' => 'required|unique:users,username|max:255',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('pages.admin.user.edit', compact('users'));
    }

    public function update(Request $request, string $id)
    {
        $users = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|max:255|unique:users,name,' . $users->id,
            'username' => 'required|max:255|unique:users,username,' . $users->id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name'     => $request->name,
            'username' => $request->username,
        ];

        // Jika password diisi, hash dan simpan
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $users->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}