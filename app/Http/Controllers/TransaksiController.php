<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Member;
use App\Models\Paket;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
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
        $transaksis = Transaksi::with(['member', 'user', 'outlet', 'detailTransaksi.paket'])->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $this->checkAccess();
        $members = Member::all();
        $pakets = Paket::where('id_outlet', session('id_outlet'))->get();
        return view('transaksi.create', compact('members', 'pakets'));
    }

    public function store(Request $request)
    {
        $this->checkAccess();
        
        $request->validate([
            'id_member' => 'required',
            'kode_invoice' => 'required|unique:tb_transaksi,kode_invoice',
            'id_paket' => 'required|array',
            'qty' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            // 1. Panggil Stored Procedure MySQL: tambah_transaksi
            DB::statement("CALL tambah_transaksi(?, ?, ?, ?)", [
                session('id_outlet'),
                $request->kode_invoice,
                $request->id_member,
                session('id_user')
            ]);

            // Ambil ID transaksi yang baru saja dibuat
            $transaksiBaru = Transaksi::latest('id')->first();

            // 2. Panggil Stored Procedure MySQL: tambah_detail_transaksi untuk setiap item paket
            foreach ($request->id_paket as $index => $id_paket) {
                if ($request->qty[$index] > 0) {
                    DB::statement("CALL tambah_detail_transaksi(?, ?, ?, ?)", [
                        $transaksiBaru->id,
                        $id_paket,
                        $request->qty[$index],
                        $request->keterangan[$index] ?? 'Cuci pakaian'
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Entri transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $this->checkAccess();
        
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function bayar($id)
    {
        $this->checkAccess();

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'dibayar' => 'dibayar',
            // Tanggal bayar akan otomatis diisi oleh Trigger database sebelum update
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function show($id)
{
    $this->checkAccess();
    $transaksi = Transaksi::with(['member', 'user', 'outlet', 'detailTransaksi.paket'])->findOrFail($id);
    return view('transaksi.show', compact('transaksi'));
}
}