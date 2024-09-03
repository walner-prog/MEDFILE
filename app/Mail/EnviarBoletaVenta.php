<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class EnviarBoletaVenta extends Mailable
{
    use Queueable, SerializesModels;

    public $venta;
    public $pdfPath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($venta, $pdfPath)
    {
        $this->venta = $venta;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdfName = 'boleta-venta-' . $this->venta->id . '.pdf';
        $pdfPath = storage_path('app/public/' . $pdfName);

        return $this->view('emails.boleta-venta') // Vista del correo electrónico
                    ->attach($pdfPath, [
                        'as' => $pdfName, // Nombre del archivo adjunto
                        'mime' => 'application/pdf', // Tipo MIME del archivo adjunto
                    ])
                    ->subject('Boleta de Venta'); // Asunto del correo electrónico
    }
}
