<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $primaryKey = 'id_layanan';
    protected $fillable = [
        'nama_layanan',
        'gambar_layanan',
        'deskripsi_layanan',
        'harga_layanan',
    ];
    public function transaksiLayanan()
    {
        return $this->hasMany(TransaksiLayanan::class);
    }
}
