<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
         <!-- Agrega esto en la sección head de tu HTML -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-TCJ6FYD6dMj4wsiWZz6swnVMqB5RW2MaebusGM1h8zE3DlX5C4sG5ndooMU2t7pLzYl5GmMKa9oB/njpy5Ul9w==" crossorigin="anonymous" />
              <!-- Otros encabezados -->
    
    @section('css')
      <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    

  @stop
      <!-- Otros elementos del encabezado... -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <head>
        <script>
          (function() {
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'dark') {
              document.documentElement.classList.add('dark-mode');
              document.documentElement.classList.remove('light-mode');
            } else if (currentTheme === 'light') {
              document.documentElement.classList.add('light-mode');
              document.documentElement.classList.remove('dark-mode');
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
              document.documentElement.classList.add('dark-mode');
            } else {
              document.documentElement.classList.add('light-mode');
            }
          })();
        </script>
        <!-- Resto de tu <head> -->
      </head>
      

  </head>
<body>
    
    
@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content_header')
    <h1>Editar Perfil</h1>
@stop

@section('content')
    {{-- Contenido para la edición del perfil --}}
    <form action="{{ route('profile.update') }}" method="post">
        @csrf
        @method('put')

        {{-- Agrega campos para la edición del perfil --}}
        <label for="name">Nombre</label>
        <input type="text" name="name" value="{{ Auth::user()->name }}" required>

        {{-- Otros campos y lógica de edición del perfil --}}
        {{-- Profile picture field --}}
  <div class="input-group mb-3">
    <input type="file" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror">

    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-image"></span>
        </div>
    </div>

    @error('profile_picture')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
   </div>

   {{-- Code field --}}
   <div class="input-group mb-3">
    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
           value="{{ old('code', Auth::user()->code) }}" placeholder="{{ __('Code (5 digits)') }}">

    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-key"></span>
        </div>
    </div>

    @error('code')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
   </div>
        
        <button type="submit">Guardar Cambios</button>
    </form>
@stop

</body>
</html>
