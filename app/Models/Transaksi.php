<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_outlet',
        'kode_invoice',
        'id_member',
        'tgl',
        'batas_waktu',
        'tgl_bayar',
        'biaya_tambahan',
        'diskon',
        'pajak',
        'status',
        'dibayar',
        'id_user',
    ];

    // Relasi: Transaksi milik satu outlet
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet', 'id');
    }

    // Relasi: Transaksi milik satu member
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    // Relasi: Transaksi dicatat oleh satu user (kasir/admin)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi: Satu transaksi memiliki banyak detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id');
    }

    // Method untuk memanggil function MySQL `hitung_total_transaksi`
    public function getTotalHargaAttribute()
    {
        $result = DB::select("SELECT hitung_total_transaksi(?) as total", [$this->id]);
        return $result[0]->total ?? 0;
    }
}