<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'tb_paket';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_outlet',
        'jenis',
        'nama_paket',
        'harga',
    ];

    // Relasi: Paket milik satu outlet
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet', 'id');
    }

    // Relasi: Paket ada di detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_paket', 'id');
    }
}