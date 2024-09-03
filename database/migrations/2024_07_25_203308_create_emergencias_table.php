<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id'); // Relación con la tabla pacientes
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('no_expediente')->nullable();
            $table->string('unidad_salud')->nullable();
            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->integer('edad')->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->string('sala_servicio')->nullable();
            $table->string('cama')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('direccion_residencia')->nullable();
            $table->string('localidad')->nullable();
            $table->string('departamento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('no_inss')->nullable();
            $table->string('no_cedula')->nullable();
            $table->string('medio_llegada')->nullable();
            $table->string('causa_accidente_violencia')->nullable();
            $table->string('causa_tratamiento')->nullable();
            $table->string('lugar_accidente_violencia')->nullable();
            $table->string('vif')->nullable();
            $table->string('direccion_avisar')->nullable();
            $table->string('parentesco')->nullable();
            $table->string('telefono_responsable')->nullable();
            $table->string('localidad_avisar')->nullable();
            $table->string('ciudad_avisar')->nullable();
            $table->string('departamento_avisar')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('talla', 5, 2)->nullable();
            $table->decimal('temperatura', 4, 1)->nullable();
            $table->string('nombre_quien_atiende')->nullable();
            $table->integer('frecuencia_cardiaca')->nullable();
            $table->integer('frecuencia_respiratoria')->nullable();
            $table->text('examen_fisico')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('planes')->nullable();
            $table->string('diagnostico_egreso')->nullable();
            $table->string('tipo_urgencia')->nullable();
            $table->string('destino_paciente')->nullable();
            $table->string('referencia')->nullable();
            $table->string('hospitalizacion')->nullable();
            $table->string('consulta_externa')->nullable();
            $table->string('fuga')->nullable();
            $table->string('salida_exigida')->nullable();
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
        Schema::dropIfExists('emergencias');
    }
}
