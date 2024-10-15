<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('id');
            $table->string('no_expediente')->nullable();
            $table->string('password');
            $table->date('fecha')->nullable();

            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();

           
            $table->integer('edad')->nullable();
            $table->date('fecha_nacimiento')->nullable(); // por ajax 
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->string('establecimiento_salud')->nullable();
            $table->string('raza_etnia')->nullable();
            $table->string('no_cedula')->nullable();
            $table->string('categoria')->nullable();
            $table->string('no_inss')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
            $table->string('nombre_responsable')->nullable();
            $table->string('escolaridad')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('direccion_residencia')->nullable();
            $table->string('localidad')->nullable();
            $table->string('municipio')->nullable();
            $table->string('departamento')->nullable();
            $table->integer('pacientes_count')->default(0)->change();
            
            $table->string('responsable_emergencia')->nullable();
            $table->string('parentesco')->nullable();
            $table->string('telefono_responsable')->nullable();
            $table->string('direccion_responsable')->nullable();
            $table->string('empleador')->nullable();
            $table->string('direccion_empleador')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('foto')->nullable();

            // Agregar una clave foránea si es necesario
            $table->foreign('doctor_id')->references('id')->on('doctores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
