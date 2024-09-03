<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroAdmisionEgresoHospitalarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_admision_egreso_hospitalario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id'); // Relación con la tabla pacientes
            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();

            $table->string('no_expediente')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('no_cedula')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('escolaridad')->nullable();

            $table->string('categoria_paciente')->nullable();
            $table->string('no_inss')->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->string('establecimiento_salud')->nullable();
            $table->string('direccion_residencia')->nullable();
            $table->string('localidad')->nullable();
            $table->string('municipio')->nullable();
            $table->string('departamento')->nullable();
           
            
       
            $table->string('raza_etnia')->nullable();
            $table->integer('edad')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('nombre_madre')->nullable();
            $table->string('nombre_padre')->nullable();
          
            $table->string('urgencia_avisar')->nullable();
            $table->string('direccion_telefono_avisar')->nullable();
            $table->string('ingreso')->nullable();
            $table->string('empleador')->nullable();
            $table->string('direccion_empleador')->nullable();
            $table->string('municipio_distrito')->nullable();
         
            $table->string('parentesco')->nullable();
            $table->string('diagnostico_ingreso')->nullable();
            $table->string('forma_llegada_hospital')->nullable();
            $table->boolean('reingreso_mismo_diagnostico')->nullable();
            $table->string('sitio_ingreso_hospitalario')->nullable();
            $table->string('nombre_medico')->nullable();
            $table->string('sello_medico_ingreso')->nullable();

            $table->date('egreso_fecha')->nullable();
            $table->time('egreso_hora')->nullable();
            $table->string('diagnostico_egreso')->nullable();
            $table->string('diagnostico_egreso_principal')->nullable();
            $table->string('diagnostico_egreso_complementarios')->nullable();
            $table->text('cirugias_realizadas')->nullable();
            $table->string('nombre_admisionista')->nullable();
            $table->integer('dias_estancia')->nullable();
            
            $table->boolean('accidente_trabajo')->nullable();
            $table->boolean('de_trayecto')->nullable();
            $table->boolean('enfermedad_laboral')->nullable();
            $table->string('causa_trauma')->nullable();
            $table->boolean('infeccion_intrahospitalaria')->nullable();
            $table->string('referido_otro_establecimiento')->nullable();
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
        Schema::dropIfExists('registro_admision_egreso_hospitalario');
    }
}
