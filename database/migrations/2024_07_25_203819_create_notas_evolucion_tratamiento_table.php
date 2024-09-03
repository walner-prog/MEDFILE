<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasEvolucionTratamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas_evolucion_tratamiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id'); // Relación con la tabla pacientes
            $table->string('establecimiento_salud')->nullable();
            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->string('no_expediente')->nullable();
            $table->string('no_cedula')->nullable();
            $table->string('servicio')->nullable();
            $table->string('no_cama')->nullable();
            $table->string('sala')->nullable();
            $table->string('no_inss')->nullable();
            $table->dateTime('fecha_hora')->nullable();
            $table->text('problemas_evolucion')->nullable();
            $table->text('planes')->nullable();
            $table->text('participantes_atencion')->nullable(); 
            $table->string('firma_codigo_profesional')->nullable(); 
            $table->timestamps();

            // Llave foránea
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas_evolucion_tratamiento');
    }
}
