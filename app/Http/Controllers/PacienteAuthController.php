<?php
namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class PacienteAuthController extends Controller
{

    public function index(){

   return view('probar');
    }


    public function showRegistrationForm()
    {
        return view('pacientes.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'expediente' => 'required|unique:pacientes|digits_between:1,10', // Ajusta según el formato de tu expediente
            'password' => 'required|min:8|confirmed',
        ]);

        Paciente::create([
            'expediente' => $request->expediente,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pacientes.login')->with('success', 'Registro exitoso.');
    }

    public function someProtectedRoute()
{
    if (!auth('paciente')->check()) {
        session(['url.intended' => request()->url()]); // Almacenar la URL de intento
        return redirect()->route('login'); // Redirigir a la página de inicio de sesión
    }

    // Lógica de la ruta protegida...
}


    public function showLoginForm()
    {
        return view('pacientes_portal.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'no_expediente' => 'required',
            'password' => 'required',
        ]);
    
        $paciente = Paciente::where('no_expediente', $request->no_expediente)->first();
    
        if ($paciente && Hash::check($request->password, $paciente->password)) {
            Auth::guard('paciente')->login($paciente);
    
            // Redirigir a la URL almacenada o a la ruta predeterminada
            return redirect()->intended(route('medfile-pacientes.home'))->with('info', 'Inicio correcto.');
        }
    
        return back()->withErrors([
            'no_expediente' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }
    

    public function perfil()
    {
        // Obtener el paciente autenticado
        $paciente = Auth::guard('paciente')->user();

        // Pasar los datos del paciente a la vista
        return view('pacientes_portal.perfil', compact('paciente'));
    }
    
    public function logout(Request $request)
    {
        Auth::guard('paciente')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pacientes.login');
    }
    
}
