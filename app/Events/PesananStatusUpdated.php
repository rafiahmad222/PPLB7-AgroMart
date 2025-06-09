<?php

namespace App\Events;

use App\Models\Pesanan;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PesananStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pesanan;

    public function __construct(Pesanan $pesanan)
    {
        $this->pesanan = $pesanan;
    }
}
