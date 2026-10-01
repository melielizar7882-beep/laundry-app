<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    private function checkAccess()
    {
        if (!session()->has('id_user') || !in_array(session('role'), ['admin', 'kasir'])) {
            abort(403, 'Akses ditolak.');
        }
    }

    public function index()
    {
        $this->checkAccess();
        $members = Member::all();
        return view('member.index', compact('members'));
    }

    public function create()
{
    // Batasi hak akses: Hanya Admin dan Kasir/Pelanggan yang boleh mendaftarkan member
    if (!session()->has('id_user') || !in_array(session('role'), ['admin', 'kasir'])) {
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    return view('member.create');
}

public function store(Request $request)
{
    if (!session()->has('id_user') || !in_array(session('role'), ['admin', 'kasir'])) {
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses.');
    }

    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'jenis_kelamin' => 'required|in:L,P',
        'tlp' => 'required|string|max:15',
    ]);

    \App\Models\Member::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tlp' => $request->tlp,
    ]);

    return redirect()->route('member.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
}

    public function edit($id)
    {
        $this->checkAccess();
        $member = Member::findOrFail($id);
        return view('member.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAccess();
        $request->validate([
            'nama' => 'required|max:100',
            'alamat' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tlp' => 'required|max:15',
        ]);

        $member = Member::findOrFail($id);
        $member->update($request->all());
        return redirect()->route('member.index')->with('success', 'Data member berhasil diubah.');
    }

    public function destroy($id)
    {
        $this->checkAccess();
        Member::destroy($id);
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus.');
    }
}