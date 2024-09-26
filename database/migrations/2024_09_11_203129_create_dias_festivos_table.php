<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiasFestivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias_festivos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->unique(); // Fecha del día festivo
            $table->string('descripcion')->nullable(); // Descripción opcional del festivo
            
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
        Schema::dropIfExists('dias_festivos');
    }
}
