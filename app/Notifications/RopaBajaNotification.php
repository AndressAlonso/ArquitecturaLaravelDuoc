<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RopaBajaNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $servicioClinico;

    public function __construct($servicioClinico)
    {
        $this->servicioClinico = $servicioClinico;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Alerta: Ropa con Cantidad Baja')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line('El servicio clínico ' . $this->servicioClinico->nombre . ' tiene ropa con cantidad baja.')
            ->action('Ver Servicio', url('/servicios/' . $this->servicioClinico->id))
            ->line('Gracias por tu atención.');
    }
}
