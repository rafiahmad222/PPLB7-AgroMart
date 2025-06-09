<?php

namespace App\Listeners;

use App\Events\PesananStatusUpdated;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPesananStatusNotificationToCustomer implements ShouldQueue
{
    use InteractsWithQueue;

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(PesananStatusUpdated $event)
    {
        $this->notificationService->createStatusUpdateNotification($event->pesanan);
    }
}
