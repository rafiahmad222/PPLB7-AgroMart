<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'komentars';
    protected $primaryKey = 'id_komentar';
    protected $fillable = [
        'konten',
        'user_id',
        'artikel_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id', 'id_artikel');
    }
}
