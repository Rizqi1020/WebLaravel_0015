<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 1. Menampilkan halaman Login (Membuka file di folder views/auth/login.blade.php)
    public function showLogin()
    {
        return view('auth.login'); 
    }

    // 2. Menampilkan halaman Register (Membuka file di folder views/auth/register.blade.php)
    public function showRegister()
    {
        return view('auth.register');
    }

    // 3. Memproses Form Login saat tombol submit ditekan
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/'); 
        }

        return back()->with('error', 'Email atau password salah!');
    }

    // 4. Memproses Form Register saat tombol submit ditekan
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Otomatis login setelah berhasil mendaftar
        Auth::login($user);

        return redirect('/');
    }

    // 5. Memproses Logout saat tombol LOG OUT di navbar diklik
    public function logout(Request $request)
    {
        Auth::logout();
        
        // Hancurkan session agar aman
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}