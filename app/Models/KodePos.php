<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KodePos extends Model
{
    use HasFactory;

    protected $table = 'kode_pos';
    protected $primaryKey = 'id_kode_pos';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['kode_pos', 'id_kecamatan'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    public function alamats()
    {
        return $this->hasMany(Alamat::class, 'id_kode_pos');
    }
}
