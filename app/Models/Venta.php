<?php

// app/Models/Venta.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'usuario_id',
        'producto_id',
        'descuento',
        'impuesto',
        'total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function detallesVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
// En el modelo Venta (o como se llame)
public function productos()
{
    return $this->belongsToMany(Producto::class)->withPivot('cantidad');
}


}

