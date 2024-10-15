<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CitaProximaNotification extends Notification
{
    use Queueable;

    protected $cita;

    public function __construct($cita)
    {
        $this->cita = $cita;
    }

    public function via($notifiable)
    {
        return ['database']; // Puedes usar 'mail', 'database', o ambos
    }

    public function toDatabase($notifiable)
    {
        return [
            'cita_id' => $this->cita->id,
            'fecha_cita' => $this->cita->fecha_cita,
            'hora_cita' => $this->cita->hora_cita,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'cita_id' => $this->cita->id,
            'fecha_cita' => $this->cita->fecha_cita,
            'hora_cita' => $this->cita->hora_cita,
        ];
    }
}
