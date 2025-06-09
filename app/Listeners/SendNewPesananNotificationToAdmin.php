<?php

namespace App\Listeners;

use App\Events\NewPesananCreated;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendNewPesananNotificationToAdmin implements ShouldQueue
{
    use InteractsWithQueue;

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(NewPesananCreated $event)
    {
        Log::info('Listener SendNewPesananNotificationToAdmin dijalankan untuk pesanan #' . $event->pesanan->id_pesanan);
        $this->notificationService->createPesananNotificationForAdmin($event->pesanan);
        Log::info('Selesai membuat notifikasi untuk pesanan #' . $event->pesanan->id_pesanan);
    }
}
