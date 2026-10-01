<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $table = 'tb_outlet';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'alamat',
        'tlp',
    ];

    // Relasi: Satu outlet memiliki banyak paket
    public function paket()
    {
        return $this->hasMany(Paket::class, 'id_outlet', 'id');
    }

    // Relasi: Satu outlet memiliki banyak user/pengguna
    public function user()
    {
        return $this->hasMany(User::class, 'id_outlet', 'id');
    }

    // Relasi: Satu outlet memiliki banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_outlet', 'id');
    }
}