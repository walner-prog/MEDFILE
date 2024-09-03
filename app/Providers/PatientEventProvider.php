<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Models\Paciente;

class PatientEventProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paciente::saved(function ($paciente) {
            Cache::forget('paciente_' . $paciente->id);
        });
    }
}
