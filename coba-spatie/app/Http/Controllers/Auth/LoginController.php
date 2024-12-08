<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan Anda memiliki file view auth/login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Cek role user
            $user = Auth::user();
            if ($user->hasRole === 'Administrator') {
                return redirect()->intended('/dashboard');
            } elseif ($user->hasRole === 'Staff') {
                return redirect()->intended('/dashboard');
            }

            // Default redirect jika role tidak dikenali
            return redirect()->intended('/login');
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
