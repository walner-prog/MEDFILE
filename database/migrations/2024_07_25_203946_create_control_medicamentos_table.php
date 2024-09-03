<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id'); // Relación con la tabla pacientes
            $table->string('establecimiento_salud')->nullable();
            $table->string('no_expediente')->nullable();
            $table->string('no_cedula')->nullable();
            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('no_inss')->nullable();
            $table->string('servicio')->nullable();
            $table->string('no_cama')->nullable();
            $table->string('sala')->nullable();
            $table->text('medicamentos_otros')->nullable();
            $table->date('fecha_medicamentos')->nullable();
            $table->time('hora_medicamentos')->nullable();
            $table->text('medicamentos_stat_prn_preanestesico')->nullable();
            $table->time('hora_medicamentos_stat_prn')->nullable();
            $table->date('fecha_medicamentos_stat_prn')->nullable();
            $table->string('nombre_enfermera_codigo')->nullable(); // Nombre y código de la enfermera
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
        Schema::dropIfExists('control_medicamentos');
    }
}
