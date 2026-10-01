<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Outlet;

class PaketController extends Controller
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
        $pakets = Paket::with('outlet')->get();
        return view('paket.index', compact('pakets'));
    }

    public function create()
    {
        $this->checkAdmin();
        $outlets = Outlet::all();
        return view('paket.create', compact('outlets'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required|in:kiloan,selimut,bed_cover,kaos,lain',
            'nama_paket' => 'required|max:100',
            'harga' => 'required|numeric',
        ]);

        Paket::create($request->all());
        return redirect()->route('paket.index')->with('success', 'Paket cucian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $this->checkAdmin();
        $paket = Paket::findOrFail($id);
        $outlets = Outlet::all();
        return view('paket.edit', compact('paket', 'outlets'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();
        $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required|in:kiloan,selimut,bed_cover,kaos,lain',
            'nama_paket' => 'required|max:100',
            'harga' => 'required|numeric',
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update($request->all());
        return redirect()->route('paket.index')->with('success', 'Paket cucian berhasil diubah.');
    }

    public function destroy($id)
    {
        $this->checkAdmin();
        Paket::destroy($id);
        return redirect()->route('paket.index')->with('success', 'Paket cucian berhasil dihapus.');
    }
}