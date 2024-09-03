<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Yajra\DataTables\Facades\DataTables;
class RegistroPacientesController extends Controller
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
      //  $paciente = Paciente::with(['emergencias', 'historiasClinicas', 'controlMedicamentos', 'informesCondicionDiaria', 'listaProblemas', 'notasEvolucionTratamiento', 'registrosAdmisionEgresoHospitalario'])->get();
        return view('registro_pacientes.index');
    }

  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        $paciente = Paciente::with(['emergencias', 'historiasClinicas', 'controlMedicamentos', 'informesCondicionDiaria', 'listaProblemas', 'notasEvolucionTratamiento', 'registrosAdmisionEgresoHospitalario'])->findOrFail($id);
        return view('registro_pacientes.show', compact('paciente'));
    }*/

    public function show($id)
{
    $paciente = Paciente::findOrFail($id);
    $registrosAdmisionEgreso = $paciente->registrosAdmisionEgresoHospitalario;

    // Ordenar los registros por fecha para determinar el más reciente
    $registrosAdmisionEgreso = $registrosAdmisionEgreso->sortByDesc('fecha_admision'); // Ajusta el campo según tu modelo

    // Obtener el registro más reciente
    $registroMasReciente = $registrosAdmisionEgreso->first();

    return view('registro_pacientes.show', [
        'paciente' => $paciente,
        'registrosAdmisionEgreso' => $registrosAdmisionEgreso,
        'registroMasReciente' => $registroMasReciente,
    ]);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
