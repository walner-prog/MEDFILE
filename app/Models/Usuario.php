<?php

// app/Models/Usuario.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $primaryKey = 'UsuarioID';
    protected $fillable = ['Nombre', 'Direccion', 'email', 'password', 'Contacto', 'RolID'];

   public function rol(){

    return $this->belongsTo(Rol::class, 'RolID');
   }

 

    
}