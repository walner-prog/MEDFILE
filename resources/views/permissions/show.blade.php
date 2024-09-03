{{-- @extends('layouts.app') --}}

<section>

    @extends('adminlte::page')
    
    @section('title', 'CAPS GNT')
    
    @section('content_header')
        <div class="card bg-primary text-white">
            <div class="card-header">
                <h1>ver dettales de un permiso </h1>
            </div>
        </div>
    @stop
    
    
    @section('content')
        <div class="card">
            <div class="card-body text-success">
                <p>Bienvenido al panel de permisos , {{ Auth::user()->name }}.</p>
            </div>
        </div>
    @stop
    
    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    @stop
    
    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
    </section>