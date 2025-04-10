<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'nama_produk',
        'gambar_produk',
        'jumlah_stok',
        'harga_produk',
        'deskripsi_produk',
        'id_kategori'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'produk_id', 'id_produk');
    }
}
