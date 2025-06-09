<?php

namespace App\Events;

use App\Models\Pesanan;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewPesananCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pesanan;

    public function __construct(Pesanan $pesanan)
    {
        $this->pesanan = $pesanan;
        Log::info('Event NewPesananCreated dipanggil untuk pesanan #' . $pesanan->id_pesanan);
    }
}
