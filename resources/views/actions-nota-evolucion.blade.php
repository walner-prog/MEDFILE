

@section('css')
    


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />
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
<body class="bg-gray-100 p-4" >
    <div class="btn-wrapper" style="width: 200px">
        <a href="{{ route('notas_evolucion_tratamiento.show', $id) }}" target="_blank" class="btn btn-purple">
            <i class="fas fa-eye"></i>
            <span class="tooltip">Ver</span>
        </a>
        <a href="{{ route('notas_evolucion_tratamiento.edit', $id) }}" class="btn btn-green">
            <i class="fas fa-edit"></i>
            <span class="tooltip">Editar</span>
        </a>

       
        <button type="button" class="btn btn-orange delete-btn" data-id="{{ $id }}">
            <i class="fas fa-trash"></i>
            <span class="tooltip">Eliminar</span>
        </button>
      
    </div>

    <!-- FontAwesome CDN -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>