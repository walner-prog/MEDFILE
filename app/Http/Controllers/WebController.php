<?php

namespace App\Http\Controllers;
use App\Models\Consultorio;
use App\Models\HorarioDoctor;
use App\Models\Doctor;
use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $horarios = HorarioDoctor::with('doctor','consultorio')->get();
    
           return view('welcome' , compact('horarios','doctores','consultorios'));
    }

       
    public function horarios_doctor_consultorio($id)
    
    {

        $horario = Consultorio::find($id);
    
        try {
            // Se utiliza Eloquent para obtener los horarios, incluyendo las relaciones con 'doctor' y 'consultorio'.
            $horarios = HorarioDoctor::with(['doctor', 'consultorio'])
                // Filtra los horarios basados en el 'consultorio_id' proporcionado en el parámetro $id.
                ->where('consultorio_id', $id)
                // Obtiene los resultados de la consulta.
                ->get();
    
            // Devuelve una vista, pasando la variable $horarios a la vista 'admin.horarios.cargar_datos_consultorios'.
            return view('horarios.horarios_doctor_consultorio', compact('horarios','horario'));
        } catch (\Exception $exception) {
            // En caso de que ocurra un error, devuelve una respuesta JSON con el mensaje 'Error'.
            return response()->json(['mensaje' => 'Error']);
        }
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
    public function show($id)
    {
        //
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
