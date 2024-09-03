@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
        
    <script src="https://cdn.jsdelivr.net/npm/lazysizes"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
</head>

<body>
  
@section('content')

<body >

  <style>
    .bg{
      background: #16222A;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #3A6073, #16222A);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #3A6073, #16222A); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
color: white;
    }
      .btn-cyan {
  background-color: #06b6d4; /* Cyan 500 */
  color: white;
  border-radius: 0.375rem; /* Bordes redondeados */
  padding: 0.5rem 1rem; /* Relleno del botón */
  border: 1px solid #06b6d4; /* Opcional: borde del mismo color */
}

.btn-cyan:hover {
  background-color: #05a3c6; /* Cyan 600 (un tono más oscuro al pasar el ratón) */
  color: white;
}
.btn-green {
  background-color: #10b981; /* Green 500 */
  color: white;
  border-radius: 0.375rem; /* Bordes redondeados */
  padding: 0.5rem 1rem; /* Relleno del botón */
  border: 1px solid #10b981; /* Opcional: borde del mismo color */
}

.btn-green:hover {
  background-color: #0f9d6d; /* Green 600 (un tono más oscuro al pasar el ratón) */
  color: white;
}

  </style>  
 <div class="container d-flex justify-content-center align-items-center vh-100">
  
  <div class="card bg-light shadow-lg" style="max-width: 400px; width: 100%;">
    <div class="card-body text-center">
      <img 
        src="{{ asset('storage/logo-sin-fondo.png') }}" 
        alt="logo" 
        class="img-fluid mb-4" 
        style="max-width: 270px; height: auto;">
        
      <p class="mb-4">Por favor ingresa a tu cuenta</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
          <input 
            type="email" 
            id="form2Example11" 
            class="form-control @error('email') is-invalid @enderror" 
            name="email" 
            value="{{ old('email') }}" 
            required 
            autocomplete="email" 
            autofocus 
            placeholder="Correo electrónico" />
          <label class="form-label" for="form2Example11">Correo electrónico</label>
          @error('email')
            <div class="invalid-feedback">
              <span class="text-danger">El correo o clave que ingresaste son incorrectos</span>
            </div>
          @enderror
        </div>

        <div class="mb-4">
          <input 
            type="password" 
            id="form2Example22" 
            class="form-control @error('password') is-invalid @enderror" 
            name="password" 
            required 
            autocomplete="current-password" 
            placeholder="Contraseña" />
          <label class="form-label" for="form2Example22">Contraseña</label>
          @error('password')
            <div class="invalid-feedback">
              <span class="text-danger">La contraseña que ingresaste es incorrecta</span>
            </div>
          @enderror
        </div>

        <div class="form-group text-center mb-4">
          <div class="form-check">
            <input 
              class="form-check-input" 
              type="checkbox" 
              name="remember" 
              id="remember" 
              {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
              {{ __('Recordarme') }}
            </label>
          </div>
        </div>

        <div class="text-center pt-1 mb-4">
          <button 
            class="btn btn-green btn-block fa-lg gradient-custom-2" 
            type="submit">
            Ingresar
          </button>
          <a class="text-muted d-block mt-2" href="#!">¿Olvidaste tu contraseña?</a>
        </div>

       

      </form>
    </div>
  </div>
</div>



</body>

</html>
@endsection

</body>
</html>
