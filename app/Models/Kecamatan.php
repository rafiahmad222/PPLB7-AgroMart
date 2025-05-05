<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $primaryKey = 'id_kecamatan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama_kecamatan', 'id_kabupaten_kota'];

    public function kabupatenKota()
    {
        return $this->belongsTo(KabupatenKota::class, 'id_kabupaten_kota');
    }

    public function kodePos()
    {
        return $this->hasMany(KodePos::class, 'id_kecamatan');
    }

    public function alamats()
    {
        return $this->hasMany(Alamat::class, 'id_kecamatan');
    }
}
