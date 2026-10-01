<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        // Laporan bisa diakses Admin, Kasir, dan Owner
        if (!session()->has('id_user')) {
            return redirect('/login');
        }

        // Ambil seluruh data transaksi lengkap dengan relasinya untuk digenerate jadi laporan
        $transaksis = Transaksi::with(['member', 'user', 'outlet', 'detailTransaksi.paket'])->get();
        
        return view('laporan.index', compact('transaksis'));
    }
}