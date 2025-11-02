<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthC extends Controller
{
    // Tampilkan halaman login
    public function login()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Proses login (username + password)
    public function loginStore(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil user berdasarkan username
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['username' => 'Username atau password salah']);
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Ambil roles user dari tabel role_user
        $roles = DB::table('role_user')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('role_user.user_id', $user->id)
            ->pluck('roles.name')
            ->toArray();

        // Simpan roles ke session
        session(['roles' => $roles]);

        // Redirect sesuai role utama (prioritas: admin > kasir > gudang)
        if (in_array('admin', $roles)) {
            return redirect()->route('dashboard');
        } elseif (in_array('apoteker', $roles)) {
            return redirect()->route('dashboard');
        } elseif (in_array('kasir', $roles)) {
            return redirect()->route('dashboard');
        } elseif (in_array('gudang', $roles)) {
            return redirect()->route('dashboard');
        } else {
            // Default fallback
            return redirect('/dashboard');
        }
    }
}
