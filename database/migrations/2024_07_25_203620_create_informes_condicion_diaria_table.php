<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformesCondicionDiariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informes_condicion_diaria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id'); // Relación con la tabla pacientes
            $table->date('fecha');
            $table->string('servicio')->nullable();
            $table->string('sala')->nullable();
            $table->string('no_expediente')->nullable();
            $table->dateTime('fecha_hora_condicion')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('procedimientos')->nullable();
            $table->string('brindada_por')->nullable();
            $table->string('recibida_por')->nullable();
            $table->string('firma_quien_recibe')->nullable();
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
        Schema::dropIfExists('informes_condicion_diaria');
    }
}
