<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'type',
        'is_read',
        'data',
        'pesanan_id'  // Menggunakan pesanan_id alih-alih order_id
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pesanan()  // Relasi ke model Pesanan
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id_pesanan');
    }
}
