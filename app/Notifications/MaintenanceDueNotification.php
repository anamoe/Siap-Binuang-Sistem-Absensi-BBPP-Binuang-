<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Aset;
use Illuminate\Notifications\Notification;

class MaintenanceDueNotification extends Notification
{
    use Queueable;

    /**
     * Objek aset yang akan digunakan untuk notifikasi.
     *
     * @var \App\Models\Aset
     */
    protected $aset;

    /**
     * Buat instance notifikasi baru.
     *
     * @param \App\Models\Aset $aset
     * @return void
     */
    public function __construct(Aset $aset)
    {
        $this->aset = $aset;
    }

    /**
     * Dapatkan saluran pengiriman notifikasi.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Dapatkan representasi email dari notifikasi.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pengingat: Jadwal Pemeliharaan Aset Kantor')
            ->greeting('Halo,') // sementara statis aja
            ->line('Ini adalah pengingat untuk jadwal pemeliharaan aset kantor Anda.')
            ->line(' ')
            ->line('Detail Aset:')
            ->line('Nama Aset: ' . $this->aset->nama)
            ->line('Lokasi: ' . $this->aset->lokasi)
            ->line('Jadwal Pemeliharaan: ' . $this->aset->next_maintenance_date)
            ->action('Lihat Detail Aset', url('/aset/' . $this->aset->id))
            ->line('Terima kasih atas kerja samanya.')
            ->salutation('Hormat kami, Tim Manajemen Aset BBPP Binuang');
    }

    /**
     * Dapatkan representasi array dari notifikasi.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
