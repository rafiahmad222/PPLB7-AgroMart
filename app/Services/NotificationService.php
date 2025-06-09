<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Log;


class NotificationService
{
    public function createPesananNotificationForAdmin(Pesanan $pesanan)
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            // Cek apakah notifikasi untuk pesanan ini dan admin ini sudah ada
            $existingNotification = Notification::where('user_id', $admin->id)
                ->where('pesanan_id', $pesanan->id_pesanan)
                ->where('type', 'new_order')
                ->exists();

            if ($existingNotification) {
                Log::info('Notifikasi untuk pesanan #' . $pesanan->id_pesanan . ' dan admin #' . $admin->id . ' sudah ada. Melewati.');
                continue;
            }

            // Buat notifikasi jika belum ada
            try {
                Notification::create([
                    'user_id' => $admin->id,
                    'pesanan_id' => $pesanan->id_pesanan,
                    'message' => "Pesanan baru #{$pesanan->id_pesanan} telah masuk",
                    'type' => 'new_order',
                    'is_read' => false,
                    'data' => [
                        'pesanan_id' => $pesanan->id_pesanan,
                        'customer_name' => $pesanan->user->name ?? 'Unknown User',
                        'total_amount' => $pesanan->total,
                    ]
                ]);

                Log::info('Notifikasi dibuat untuk admin #' . $admin->id . ' dan pesanan #' . $pesanan->id_pesanan);
            } catch (\Exception $e) {
                Log::error('Error saat membuat notifikasi: ' . $e->getMessage());
            }
        }
    }

    public function createStatusUpdateNotification(Pesanan $pesanan)
    {
        $statusMessages = [
            'Diproses' => "Pesanan No. $pesanan->id_pesanan sedang diproses.",
            'Dikirim' => "Pesanan No. $pesanan->id_pesanan telah dikirim.",
            'Diterima' => "Silahkan Selesaikan Pesanan No. $pesanan->id_pesanan.",
            'Selesai' => "Pesanan No. $pesanan->id_pesanan telah selesai.",
        ];

        // Sesuaikan dengan field status di tabel pesanans
        $message = $statusMessages[$pesanan->status] ?? "Status pesanan Anda berubah menjadi: {$pesanan->status}";

        Notification::create([
            'user_id' => $pesanan->user_id,
            'pesanan_id' => $pesanan->id_pesanan,
            'message' => $message,
            'type' => 'status_update',
            'is_read' => false,
            'data' => [
                'pesanan_id' => $pesanan->id_pesanan,
                'status' => $pesanan->status,
                'updated_at' => $pesanan->updated_at
            ]
        ]);
    }
}
