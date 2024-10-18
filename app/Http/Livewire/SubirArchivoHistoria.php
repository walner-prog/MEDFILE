<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\HistoriaClinica;

class SubirArchivoHistoria extends Component
{
    use WithFileUploads;

    public $archivo_examen;
    public $historiaClinicaId;

    public function mount($historiaClinicaId)
    {
        $this->historiaClinicaId = $historiaClinicaId;
    }

    public function updatedArchivoExamen()
    {
        $this->validate([
            'archivo_examen' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
    }

    public function guardarArchivo()
    {
        $this->validate([
            'archivo_examen' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Almacenar el archivo en "public/examenes"
        $rutaArchivo = $this->archivo_examen->store('public/examenes');

        // Obtener la ruta pública
        $rutaPublica = str_replace('public/', 'storage/', $rutaArchivo);

        // Guardar la ruta en la base de datos
        $historiasClinica = HistoriaClinica::find($this->historiaClinicaId);
        $historiasClinica->archivo_examen = $rutaPublica;
        $historiasClinica->save();

        session()->flash('message', 'Archivo subido exitosamente.');
    }

    public function render()
    {
        return view('livewire.subir-archivo-historia');
    }
}
