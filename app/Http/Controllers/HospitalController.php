<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
class HospitalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Middleware de autenticación requerido para todas las funciones del controlador
    }
    // Mostrar la lista de hospitales
    public function index()
    {
        // Guardar los hospitales en caché durante 60 minutos
        $hospitales = Cache::remember('hospitales', 60, function () {
            return Hospital::all();
        });
    
        return view('hospitales.index', compact('hospitales'));
    }

    // Mostrar el formulario para crear un nuevo hospital
    public function create()
    {
        return view('hospitales.create');
    }

    // Almacenar un nuevo hospital en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_hospital' => 'required|string|max:255',
            'ruc' => 'required|string|max:20|unique:hospitales,ruc',
            'telefono_contacto' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'correo_contacto' => 'required|string|email|max:255|unique:hospitales,correo_contacto',
            'tipo_hospital' => 'required|string|max:50',
            'numero_camas' => 'required|integer|min:1',
            'nivel_atencion' => 'required|string|max:50',
        ]);

        Hospital::create($request->all());
        Cache::forget('hospitales');

        return redirect()->route('hospitales.index')->with('info', 'Hospital creado exitosamente.');
    }

    // Mostrar los detalles de un hospital específico
    public function show(Hospital $hospital)
    {
        return view('hospitales.show', compact('hospital'));
    }

    // Mostrar el formulario para editar un hospital existente
    public function edit(Hospital $hospital)
    {
        return view('hospitales.edit', compact('hospital'));
    }

    // Actualizar un hospital existente en la base de datos
    public function update(Request $request, Hospital $hospital)
    {
        $validator = Validator::make($request->all(), [
            'nombre_hospital' => 'required|string|max:255',
           // 'ruc' => 'required|string|max:20|unique:hospitales,ruc,' . $hospital->id,
            'telefono_contacto' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
           // 'correo_contacto' => 'required|string|email|max:255|unique:hospitales,correo_contacto,' . $hospital->id,
            'tipo_hospital' => 'required|string|max:50',
          //  'numero_camas' => 'required|integer|min:1',
            'nivel_atencion' => 'required|string|max:50',
        ]);

       

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores.');
        }

        $hospital->update($validator->validated());
        Cache::forget('hospitales');

        if ($hospital) {
            
            return redirect()->route('hospitales.index')->with('update', 'Hospital actualizado exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error al actualizar el Hospital.');
        }
    }
    

    // Eliminar un hospital de la base de datos
   

    public function destroy($id)
    {
      
          $hospital = Hospital::findOrFail($id);
          $hospital->delete();
  
          Cache::forget('hospitales');
          return redirect()->route('hospitales.index')->with('delete', 'Hospital eliminado exitosamente.');
      
    }
}
