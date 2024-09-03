<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_hospital');
            $table->string('ruc')->unique();  // Número de identificación fiscal del hospital
            $table->string('telefono_contacto');
            $table->string('direccion');
            $table->string('correo_contacto')->unique();
            $table->string('tipo_hospital');  // Público, privado, etc.
            $table->integer('numero_camas');  // Capacidad del hospital
            $table->string('nivel_atencion');  // Nivel de atención (primario, secundario, terciario)
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
        Schema::dropIfExists('hospitales');
    }
}
