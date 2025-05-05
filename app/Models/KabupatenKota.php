<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class KabupatenKota extends Model
{
    use HasFactory;

    protected $table = 'kabupaten_kota';
    protected $primaryKey = 'id_kabupaten_kota';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nama_kabupaten_kota'];

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'id_kabupaten_kota');
    }

    public function alamats()
    {
        return $this->hasMany(Alamat::class, 'id_kabupaten_kota');
    }
}
