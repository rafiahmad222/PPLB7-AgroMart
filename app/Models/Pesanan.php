<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';
    protected $primaryKey = 'id_pesanan';
    protected $fillable = [
        'produk_id',
        'nama',
        'alamat',
        'no_hp',
        'pengiriman',
        'jarak',
        'ongkir',
        'pembayaran',
        'total',
        'status'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }
}
