<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_ventas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('producto_id')->nullable()->constrained()->onDelete('cascade'); // Permitir nulos
            $table->decimal('impuesto', 5, 2)->default(0);
            $table->decimal('descuento', 5, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
