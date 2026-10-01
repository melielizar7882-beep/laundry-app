<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Outlet;

class UserController extends Controller
{
    private function checkAdmin()
    {
        if (!session()->has('id_user') || session('role') !== 'admin') {
            abort(403, 'Akses ditolak. Khusus Admin.');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $users = User::with('outlet')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $this->checkAdmin();
        $outlets = Outlet::all();
        return view('user.create', compact('outlets'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'nama' => 'required|max:100',
            'username' => 'required|max:30|unique:tb_user,username',
            'password' => 'required',
            'id_outlet' => 'required',
            'role' => 'required|in:admin,kasir,owner',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password, // Disimpan plain sesuai database SQL bawaan
            'id_outlet' => $request->id_outlet,
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $this->checkAdmin();
        $user = User::findOrFail($id);
        $outlets = Outlet::all();
        return view('user.edit', compact('user', 'outlets'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|max:100',
            'username' => 'required|max:30|unique:tb_user,username,' . $id,
            'id_outlet' => 'required',
            'role' => 'required|in:admin,kasir,owner',
        ]);

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'id_outlet' => $request->id_outlet,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success', 'Pengguna berhasil diubah.');
    }

    public function destroy($id)
    {
        $this->checkAdmin();
        User::destroy($id);
        return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}