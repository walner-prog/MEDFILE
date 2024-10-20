<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HistoriaClinica;
use App\Models\Paciente;

class EstadisticasHistoriasClinicas extends Component
{
    public $totalPacientes;
    public $totalHistorias;
    public $enfermedadesCronicasCount;
    public $porcentajeTabaco;
    public $porcentajeAlcohol;
    public $porcentajeDrogas;

    public function mount()
    {  
        
        $this->totalPacientes = Paciente::count();
        $this->totalHistorias = HistoriaClinica::count();
        $this->enfermedadesCronicasCount = HistoriaClinica::whereNotNull('enfermedades_cronicas')->count();
        $this->calcularPorcentajes();
    }

    public function calcularPorcentajes()
    {
        $totalHistorias = HistoriaClinica::count();
        if ($totalHistorias > 0) {
            $this->porcentajeTabaco = (HistoriaClinica::where('tabaco', true)->count() / $totalHistorias) * 100;
            $this->porcentajeAlcohol = (HistoriaClinica::where('alcohol', true)->count() / $totalHistorias) * 100;
            $this->porcentajeDrogas = (HistoriaClinica::where('drogas_ilegales', true)->count() / $totalHistorias) * 100;
        } else {
            $this->porcentajeTabaco = 0;
            $this->porcentajeAlcohol = 0;
            $this->porcentajeDrogas = 0;
        }
    }

    public function render()
    {
        return view('livewire.estadisticas-historias-clinicas', [
            'totalPacientes' => $this->totalPacientes,
            'totalHistorias' => $this->totalHistorias,
            'enfermedadesCronicasCount' => $this->enfermedadesCronicasCount,
            'porcentajeTabaco' => $this->porcentajeTabaco,
            'porcentajeAlcohol' => $this->porcentajeAlcohol,
            'porcentajeDrogas' => $this->porcentajeDrogas,
        ]);
    }
}
