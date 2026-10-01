<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Mengambil data user berdasarkan username (tanpa middleware)
        $user = User::where('username', $request->username)->first();

        // Cek user & password (di database contoh password masih plain text '123')
        if ($user && $user->password === $request->password) {
            // Simpan session login
            session([
                'id_user' => $user->id,
                'nama' => $user->nama,
                'username' => $user->username,
                'role' => $user->role,
                'id_outlet' => $user->id_outlet,
            ]);

            return redirect('/dashboard')->with('success', 'Berhasil login!');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function dashboard()
{
    if (!session()->has('id_user')) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Mengambil total inputan dari masing-masing tabel
    $jumlahOutlet = \App\Models\Outlet::count();
    $jumlahPaket = \App\Models\Paket::count();
    $jumlahMember = \App\Models\Member::count();
    $jumlahTransaksi = \App\Models\Transaksi::count();

    return view('dashboard', compact('jumlahOutlet', 'jumlahPaket', 'jumlahMember', 'jumlahTransaksi'));
}

public function showRegisterForm()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'username' => 'required|string|unique:tb_user,username',
        'password' => 'required|string|min:3',
        'id_outlet' => 'required|exists:tb_outlet,id',
        'role' => 'required|in:admin,kasir', // Validasi role yang diizinkan
    ]);

    \App\Models\User::create([
        'nama' => $request->nama,
        'username' => $request->username,
        'password' => $request->password, // Disimpan sebagai teks biasa tanpa bcrypt()
        'role' => $request->role,          // Mengambil role pilihan dari form
        'id_outlet' => $request->id_outlet,
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
}

    public function logout()
    {
        session()->flush();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}