<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'tb_user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'id_outlet',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: User milik satu outlet
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet', 'id');
    }

    // Relasi: User mencatat banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_user', 'id');
    }
}