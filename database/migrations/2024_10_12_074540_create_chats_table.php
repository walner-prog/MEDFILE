<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id') // Relación con el paciente
                  ->constrained('pacientes') // Asumiendo que la tabla se llama 'pacientes'
                  ->onDelete('cascade');     // Si se elimina el paciente, se eliminan sus chats
            $table->string('name')->nullable(); // Nombre opcional para identificar el chat
            $table->timestamps();               // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
