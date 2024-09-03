<?php
namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EspecialidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth'); // Middleware de autenticación requerido para todas las funciones del controlador
    }
    public function index()
    {
        $especialidades = Especialidad::paginate(30);
        return view('especialidades.index', compact('especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:especialidades,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Especialidad::create($request->all());

        return redirect()->route('especialidades.index')
                         ->with('info', 'Especialidad creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Especialidad $especialidad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        return view('especialidades.show', compact('especialidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Especialidad $especialidad
     * @return \Illuminate\Http\Response
     */
   // En EspecialidadesController.php

public function edit($id)
{
    $especialidad = Especialidad::find($id);
    return view('especialidades.edit', compact( 'especialidad'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Especialidad $especialidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $especialidad = Especialidad::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores.');
        }
    
        
    
        $especialidad->update($validator->validated());
    
   
    
        return redirect()->route('especialidades.index')
                         ->with('update', 'Especialidad actualizada exitosamente.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Especialidad $especialidad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $especialidad = Especialidad::findOrFail($id);
            $especialidad->delete();

            return response()->json(['delete' => 'Especialidad eliminada correctamente.']);
        } catch (\Exception $e) {
            Log::error('Error eliminando especialidad: '.$e->getMessage());
            return redirect()->route('especialidades.index')->with('delete', 'Error al eliminar la especialidad.');
        }
    }

    // Método para buscar especialidades con paginación
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $page = $request->input('page', 1);

        $especialidades = Especialidad::where('nombre', 'LIKE', "%{$query}%")
            ->paginate(10, ['*'], 'page', $page);

        return response()->json($especialidades);
    }

    // Método para obtener detalles de una especialidad específica
    public function detalles($id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            return response()->json(['error' => 'Especialidad no encontrada'], 404);
        }

        return response()->json($especialidad);
    }
}
