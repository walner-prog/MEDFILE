<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoevaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autoevaluaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->integer('horas_sueno')->nullable();
            $table->string('historia_enfermedad_actual');
            $table->string('enfermedades_cronicas')->nullable();
            $table->string('diagnostico_medico')->nullable();
            $table->integer('nivel_estres');
            $table->string('sintomas_mentales')->nullable();
            $table->string('calidad_vida')->nullable();
            $table->boolean('pregunta_1')->default(false);
            $table->boolean('pregunta_2')->default(false);
            $table->boolean('pregunta_3')->default(false);
            $table->boolean('pregunta_4')->default(false);
            $table->boolean('pregunta_5')->default(false);
            $table->boolean('pregunta_6')->default(false);
            $table->boolean('pregunta_7')->default(false);
            $table->boolean('pregunta_8')->default(false);
            $table->boolean('pregunta_9')->default(false);
            $table->boolean('pregunta_10')->default(false);
            $table->boolean('pregunta_11')->default(false);
            $table->boolean('pregunta_12')->default(false);
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
        Schema::dropIfExists('autoevaluaciones');
    }
}
