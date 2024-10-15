<!-- resources/views/home.blade.php -->
@extends('layouts.app_portal')

@section('content')
<div class="container">
  @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if (session('info'))
      <div class="alert alert-success">{{ session('info') }}</div>
  @endif

  @if (session('delete'))
      <div class="alert alert-warning">{{ session('delete') }}</div>
  @endif

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div class="row">
      <div class="col">
          <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
              <ol id="breadcrumb" class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="{{ url('/medfile-pacientes') }}">Hogar</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Registro Pacientes</li>
              </ol>
          </nav>
      </div>
  </div>

  <div class="container mt-5">
      <h1 class="text-center">Resultados de tu Autoevaluación</h1>

      <div class="text-center mb-3">
          <button id="toggleFontSize" class="btn bt-primario text-white">Agrandar Letra</button>
      </div>

      <div class="text-center mt-4">
          <button onclick="enviarResultado()" class="btn btn-success">Recibir Resultado por WhatsApp</button>
      </div>

      <div class="card mt-4" id="results">
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-6">
                      <h4>
                          {{ auth('paciente')->user()->primer_nombre }} 
                          {{ auth('paciente')->user()->segundo_nombre }} 
                          {{ auth('paciente')->user()->primer_apellido }} 
                          {{ auth('paciente')->user()->segundo_apellido }}
                      </h4>
                  </div>
                  <div class="col-lg-6">
                      <h4>Expediente: <span class="text-danger">{{ auth('paciente')->user()->no_expediente }}</span></h4>
                  </div>
              </div>
          </div>

          <div class="card-body">
              <h5 class="card-title">Recomendaciones:</h5>
              <ul class="list-group" id="recomendaciones-list">
                  @foreach ($recomendaciones as $recomendacion)
                      <li class="list-group-item">{{ $recomendacion }}</li>
                  @endforeach
              </ul>
          </div>
      </div>

      <div class="text-center mt-4">
          <a href="{{ route('autoevaluacion.index') }}" class="btn btn-secondary">Volver</a>
      </div>
  </div>
</div>


<br>
<script>
    document.getElementById('toggleFontSize').addEventListener('click', function() {
        const results = document.getElementById('results');
        results.classList.toggle('large-text');

        // Cambiar el texto del botón
        this.textContent = results.classList.contains('large-text') ? 'Letra Normal' : 'Agrandar Letra';
    });
</script>

<script>
    document.getElementById('enviarWhatsapp').addEventListener('click', function() {
        fetch("{{ route('autoevaluacion.enviar-whatsapp') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Resultado enviado exitosamente por WhatsApp.');
            } else {
                alert('Hubo un error al enviar el mensaje.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al intentar enviar el mensaje.');
        });
    });
</script>


    </div>
@endsection
@section('css')
   <style>
    .search-bar {
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
}
.card {
  border-radius: 15px;
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.card-title {
  font-size: 1.5rem;
}

.card-text {
  font-size: 1.1rem;
}

.b-pagination {
  justify-content: center;
}

.services {
  text-align: center;
}

.btn {
  width: 100%;
  transition: background-color 0.3s ease;
}

.btn:hover {
  filter: brightness(90%);
}


.bt-cyan {
  background-color: #06b6d4; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-primario {
  background-color: #0071bc; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-primario:hover {
  background-color: #09466FFF; /* Cyan 500 de Tailwind CSS */
  color: white;
}


.bt-indigo {
  background-color: #9F1FFBFF; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-indigo:hover {
  background-color: #720394FF; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-secundario {
  background-color: #7ac943; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-secundario:hover {
  background-color: #63A534FF; /* Cyan 500 de Tailwind CSS */
  color: white;
}

.bt-tercer {
  background-color: #29abe2; /* Cyan 500 de Tailwind CSS */
  color: white;
}


.bt-tercer:hover {
  background-color: #2187B3FF; /* Cyan 500 de Tailwind CSS */
  color: white;
}
   </style>
@stop