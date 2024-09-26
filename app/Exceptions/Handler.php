<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

   /* public function render($request, Throwable $exception)
{
    if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
        // Obtenemos la URL solicitada
        $urlIntentada = $request->url();

        // Redirigir con un mensaje de error que incluye la URL
        return redirect()->back()->with('error', "No tienes los permisos necesarios para acceder a la sección: $urlIntentada.");
    }

    return parent::render($request, $exception);
}
*/
/// personalizado el metodoo 
public function render($request, Throwable $exception)
{
    if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
        $urlIntentada = $request->url();
        $metodo = $request->method();
        $nombreRuta = $request->route()->getName();
        $parametrosRuta = $request->route()->parameters();
        $ipUsuario = $request->ip();
        $urlReferer = $request->headers->get('referer');

        // Puedes concatenar toda la información en un solo mensaje
        $mensaje = "No tienes los permisos necesarios para acceder a la sección: $urlIntentada. ";
        $mensaje .= "Método HTTP: $metodo. ";
        $mensaje .= "Ruta: $nombreRuta. ";
        $mensaje .= "Parámetros: " . json_encode($parametrosRuta) . ". ";
        $mensaje .= "IP: $ipUsuario. ";
        $mensaje .= "URL previa: $urlReferer.";

        return redirect()->back()->with('error', $mensaje);
    }

    return parent::render($request, $exception);
}

    
}
