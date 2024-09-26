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
            $table->foreignId('especialidad_id')->constrained('especialidades')->nullable();
            $table->foreignId('consultorio_id')->constrained('consultorios');
            $table->date('fecha_cita')->nullable();

            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('color');

            $table->time('hora_cita')->nullable();
            $table->string('tipo_cita');
            $table->integer('duracion')->default(30)->nullable(); // Duración en minutos
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
