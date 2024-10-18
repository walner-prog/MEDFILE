<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CitaCanceladaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $paciente;
    public $detalleCita;

    public function __construct($paciente, $detalleCita)
    {
        $this->paciente = $paciente;
        $this->detalleCita = $detalleCita;
    }

    public function build()
    {
        return $this->subject('Notificación de Cita')
                    ->view('emails.cita_cancelada') // Crea esta vista en resources/views/emails
                    ->with([
                        'nombre' => $this->paciente->primer_nombre,
                        'detalleCita' => $this->detalleCita,
                    ]);
    }
}
