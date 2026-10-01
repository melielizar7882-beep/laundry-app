<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;

class OutletController extends Controller
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
        $outlets = Outlet::all();
        return view('outlet.index', compact('outlets'));
    }

    public function create()
    {
        $this->checkAdmin();
        return view('outlet.create');
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'nama' => 'required|max:100',
            'alamat' => 'required|max:100',
            'tlp' => 'required|max:15',
        ]);

        Outlet::create($request->all());
        return redirect()->route('outlet.index')->with('success', 'Outlet berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $this->checkAdmin();
        $outlet = Outlet::findOrFail($id);
        return view('outlet.edit', compact('outlet'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();
        $request->validate([
            'nama' => 'required|max:100',
            'alamat' => 'required|max:100',
            'tlp' => 'required|max:15',
        ]);

        $outlet = Outlet::findOrFail($id);
        $outlet->update($request->all());
        return redirect()->route('outlet.index')->with('success', 'Outlet berhasil diubah.');
    }

    public function destroy($id)
    {
        $this->checkAdmin();
        Outlet::destroy($id);
        return redirect()->route('outlet.index')->with('success', 'Outlet berhasil dihapus.');
    }
}