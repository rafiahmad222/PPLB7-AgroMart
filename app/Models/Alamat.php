<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'alamat';              // Nama tabel
    protected $primaryKey = 'id_alamat';      // Primary key
    public $incrementing = true;              // ID auto-increment
    protected $keyType = 'int';               // Tipe data ID

    protected $fillable = [
        'user_id',
        'id_kabupaten_kota',
        'id_kecamatan',
        'id_kode_pos',
        'detail_alamat',
        'label_alamat',
    ];

    // ====================
    // Relasi
    // ====================

    // Alamat milik User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Alamat milik Kabupaten/Kota
    public function kabupatenKota()
    {
        return $this->belongsTo(KabupatenKota::class, 'id_kabupaten_kota');
    }

    // Alamat milik Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    // Alamat milik Kode Pos
    public function kodePos()
    {
        return $this->belongsTo(KodePos::class, 'id_kode_pos');
    }

    // (Opsional) Mendapatkan alamat lengkap dalam bentuk teks
    public function getAlamatLengkapAttribute()
    {
        return "{$this->detail_alamat}, {$this->kecamatan->nama}, {$this->kabupatenKota->nama}, {$this->kodePos->kode}";
    }
}
