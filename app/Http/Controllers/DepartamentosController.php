<?php
namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class DepartamentosController extends Controller
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
        $departamentos = Departamento::all();
        return view('departamentos.index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departamentos.create');
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
            'nombre' => 'required|string|max:100|unique:departamentos,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Departamento::create($request->all());

        return redirect()->route('departamentos.index')
                         ->with('info', 'Departamento creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departamento = Departamento::findOrFail($id);
        return view('departamentos.show', compact('departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departamento = Departamento::findOrFail($id);
        return view('departamentos.edit', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100|unique:departamentos,nombre,'.$departamento->id,
            'descripcion' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores.');
        }

        $departamento->update($validator->validated());

        return redirect()->route('departamentos.index')
                         ->with('update', 'Departamento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Departamento $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $departamento = Departamento::findOrFail($id);
            $departamento->delete();

            return response()->json(['delete' => 'Departamento eliminado correctamente.']);
        } catch (\Exception $e) {
            Log::error('Error eliminando departamento: '.$e->getMessage());
            return redirect()->route('departamentos.index')->with('delete', 'Error al eliminar el departamento.');
        }
    }
   
    

}
