<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiLayanan extends Model
{
    use HasFactory;
    protected $table = 'transaksi_layanans'; // Nama tabel
    protected $primaryKey = 'id_transaksi_layanan'; // Nama primary key

    protected $fillable = [
        'user_id',
        'layanan_id',
        'alamat_id',
        'jumlah',
        'pembayaran',
        'bukti_transfer',
        'total',
        'jadwal_booking',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id_layanan');
    }

    // Relasi ke Alamat
    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'alamat_id', 'id_alamat');
    }
}
