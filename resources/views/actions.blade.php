
<!DOCTYPE html>
<html lang="en">
<head>
    @section('css')
    


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-DyZv9x6q5PzW0T3S/RhvE4Fh8Nq9wZZlI12PjHwAo/nL2/zqYk77J8k9tJ4qROxr" crossorigin="anonymous">

<style>
    .btn-wrapper {
        position: relative;
        width: 280px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 0.375rem;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        border: none;
        color: #fff;
        cursor: pointer;
        text-align: center;
        position: relative;
        font-size: 1.25rem;
    }

    .btn-purple {
        background-color: #6b5b95;
    }
    .btn-purple:hover {
        background-color: #5a4e77;
    }

    .btn-green {
        background-color: #4caf50;
    }
    .btn-green:hover {
        background-color: #388e3c;
    }

    .btn-orange {
        background-color: #ff5722;
    }
    .btn-orange:hover {
        background-color: #e64a19;
    }

    .btn i {
        margin: 0;
    }

    .tooltip {
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 100;
        }

        .btn:hover .tooltip {
            opacity: 1;
            visibility: visible;
        }
</style>
@endsection
</head>

<body class="bg-gray-100 p-4" >
    <div class="btn-wrapper" style="width: 300px">
        <a href="{{ route('pacientes.show', $id) }}" target="_blank" class="btn btn-purple" title="Ver">
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route('pacientes.edit', $id) }}" class="btn btn-green" title="Editar">
            <i class="fas fa-edit"></i>
        </a>
        <button type="button" class="btn btn-orange delete-btn" data-id="{{ $id }}" title="Eliminar">
            <i class="fas fa-trash"></i>
        </button>
        @php
        $historiaClinica = \App\Models\HistoriaClinica::where('paciente_id', $id)->first();
          @endphp
    
        @if($historiaClinica)
         <a href="{{ route('historias_clinicas.show', $historiaClinica->id) }}" target="_blank" class="btn btn-indigo" title="Historia Clínica">
            <i class="fas fa-comment-medical"></i>
        </a>
        @else
    
        <p class=" text-success">No hay historia clínica disponible.</p> <!-- Para verificar que entra en el else -->
       @endif
    
    
    
    </div>
    

    <!-- FontAwesome CDN -->
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-ZVP8CjFOTvYpsgU4w3p1MxMi/6hE4D/t/biDZKj6voZpZk+EVFBl3W3fSS6HZO/7" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq2zB5U0BB+RhdJ4Z+W4F3X1OVFsI6s4wvE9ZmX2EfbpP09/TP" crossorigin="anonymous"></script>

    <script>
        // Activar tooltips de Bootstrap
$(function () {
  $('[title]').tooltip();
});

    </script>
</body>
</html>
