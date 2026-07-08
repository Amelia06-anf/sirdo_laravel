<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ]);

        $petugas = Petugas::where('username', $credentials['username'])->first();

        if (!$petugas) {
            return back()->withErrors(['login' => 'Username atau password salah.'])->onlyInput('username');
        }

        $passwordValid = Hash::check($credentials['password'], (string) $petugas->password);
        $legacyMd5Valid = md5($credentials['password']) === (string) $petugas->password;

        if (!$passwordValid && !$legacyMd5Valid) {
            return back()->withErrors(['login' => 'Username atau password salah.'])->onlyInput('username');
        }

        if ($legacyMd5Valid) {
            $petugas->password = Hash::make($credentials['password']);
            $petugas->save();
        }

        Auth::login($petugas);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
