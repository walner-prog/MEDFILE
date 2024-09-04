<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosDoctorTable extends Migration
{
    public function up()
    {
        Schema::create('horarios_doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctores');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->integer('duracion_cita')->default(30);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('horarios_doctor');
    }
}
