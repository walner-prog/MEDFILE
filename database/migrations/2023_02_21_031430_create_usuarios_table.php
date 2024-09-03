<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // database/migrations/xxxx_xx_xx_create_usuarios_table.php
public function up()
{
    Schema::create('usuarios', function (Blueprint $table) {
       
        $table->id('UsuarioID');
        $table->string('Nombre');
        $table->string('email')->unique();
       
        $table->string('password');
        $table->rememberToken();
        $table->string('Direccion');
        $table->string('Contacto');
        $table->foreignId('RolID')->constrained('rolescaps', 'RolID');
        $table->timestamp('FechaDeRegistro')->nullable();
        $table->string('InformacionDeInicioDeSesion')->nullable();
       //$table->unsignedBigInteger('RolID');
      //  $table->foreign('RolID')->references('RolID')->on('rolescaps'); // Asegúrate de que el nombre de la tabla sea correcto
      $table->timestamp('email_verified_at')->nullable(); 
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
        Schema::dropIfExists('usuarios');
    }
}
