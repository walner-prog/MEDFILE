<?php

// app/Models/Rol.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $primaryKey = 'RolID';
    protected $fillable = ['NombreDelRol']; 

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuarios_roles', 'RolID', 'UsuarioID');
    }
}