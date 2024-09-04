<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('no_expediente')->nullable(); // Opcional si ya tienes el paciente_id
            $table->foreignId('paciente_id')->constrained('pacientes');
            $table->foreignId('doctor_id')->constrained('doctores');
            $table->foreignId('especialidad_id')->constrained('especialidades');
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->string('tipo_cita');

            $table->text('descripcion_cita')->nullable();
            $table->enum('estado', ['por confirmar', 'confirmada', 'en progreso', 'cancelada', 'realizada'])->default('por confirmar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
