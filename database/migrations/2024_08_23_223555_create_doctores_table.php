<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo', 20)->unique();
            $table->string('primer_nombre', 50);
            $table->string('segundo_nombre', 50)->nullable();
            $table->string('primer_apellido', 50);
            $table->string('segundo_apellido', 50)->nullable();
            $table->string('cedula', 20)->unique();
            $table->string('telefono', 15)->nullable();
            $table->string('email', 100)->unique();
            $table->unsignedBigInteger('especialidad_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->date('fecha_contratacion')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->string('horario_trabajo', 50)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('foto', 255)->nullable();
            $table->date('fecha_nacimiento')->nullable(); 
            $table->unsignedBigInteger('pacientes_count')->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->timestamps();

            // Relaciones
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('set null');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('set null');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctores');
    }
}
