<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    //Form Login
        public function login()
    {
        return view('pages.admin.login');
    }
        public function dashboard()
    {
        if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return view('pages.admin.index');
    }

    //Proses Login
        public function proses(Request $request)
        {
            $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user) {
            // Username ditemukan, cek password
            if (Hash::check($request->password, $user->password)) {
                // Jika username dan password benar
                Auth::login($user);
                return redirect()->intended('/dashboard');
            } else {
                // Username benar, password salah
                return redirect()->back()->with('error', 'Password salah!');
        }
    } else {
        // Username tidak ditemukan
        return redirect()->back()->with('error', 'Username tidak ditemukan!');
            }
        }

        public function logout()
        {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('login')->with('success', 'Berhasil logout.');
        }

}
