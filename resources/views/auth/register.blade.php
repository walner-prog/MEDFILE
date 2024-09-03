@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
</head>

@section('content')
<body >
    <style>
        .edit_imput:focus {
         
         box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25); /* Sombra verde */
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
   <div class="container container-md" style="max-width: 800px">

    <!-- Outer Row -->
    <div class="row justify-content-center">

    

      
                <div class="card card-body bg-gradient-white shadow shadow-lg register   col-8" style="justify-content: center;">
                   
            
                   
                          
                           
                                <div class="text-center">
                                    <img src="{{ asset('storage/logo-sin-fondo.png') }}" style="width: 300px;" alt="logo">
                                    <h1 class="h4 text-gray font-weight-bold text-center">Registrate</h1>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                   
                                     <div class="form-group font-weight-bold">
                                        <div class="row mb-3">
                                            <label for="name" class="col-form-label text-gray">{{ __('Nombre') }}</label>
                                            <input id="name" type="text" placeholder="Escribe tu nombre" class="form-control edit_imput @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email input -->
                                    <div class="row mb-3 font-weight-bold">
                                        <label for="email" class="form-label text-gray">{{ __('Email o Correo') }}</label>
                                        <input id="email" type="email" placeholder="Ingresa tu correo" class="form-control edit_imput @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-group font-weight-bold">
                                        <div class="row mb-3">
                                            <label for="password" class="form-label text-gray">{{ __('Contraseña') }}</label>
                                            <input id="password" type="password" placeholder="Ingresa tu contraseña" class="form-control edit_imput @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Repeat Password input -->
                                    <div class="form-group font-weight-bold">
                                        <div class="row mb-3">
                                            <label for="password-confirm" class="form-label text-gray">{{ __('Confirmar Contraseña') }}</label>
                                            <input id="password-confirm" type="password" placeholder="Confirma tu contraseña" class="form-control edit_imput" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                     <!-- Checkbox -->
                                     <div class="form-check d-flex justify-content-center mb-4">
                                        <input class="form-check-input me-2 mr-5" type="checkbox" value="" id="rememberCheck" />
                                        <label class="form-check-label ml-5 edit_imput" for="rememberCheck">
                                            Recuérdame
                                        </label>
                                    </div>
                                 <div class="row">
                                 <div class="col-lg-6">
                                     <!-- Submit button -->
                                     <div class="form-group font-weight-bold">
                                        <div class="col-md-12 ">
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-sm  font-weight-bold w-100 btn-cyan" >
                                                {{ __('Enviar') }}
                                            </button>
                                        </div>
                                    </div>

                                 </div>

                                   
                                 </form>
                                   <div class="col-lg-6">
                                    <div class="form-group mr-6">
                                        <a class="btn btn-green btn-sm  " href="{{ route('login') }}">{{ __('Si ya estás registrado entra aquí') }}</a>
                                    </div>
                                   </div>
                            
                                
                            </div>
                        
                    </div>
                </div>
           
    </div>

</div>


</div>
</body>
@endsection
