
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@section('css')
    


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-" crossorigin="anonymous" />

@endsection
<body class="bg-gray-100 p-4" >
    <div class="btn-wrapper p-2" style="width: 270px">
        <a href="{{ route('historias_clinicas.show', $id) }}" target="_blank" class="btn btn-purple">
            <i class="fas fa-eye"></i>
            <span class="tooltip">Ver</span>
        </a>
     
         <a href="{{ route('historias_clinicas.edit', $id) }}" class="btn btn-green">
            <i class="fas fa-edit"></i>
            <span class="tooltip">Editar</span>
         </a>
     
           
      
         <!-- Código o vista para borrar una historia clínica -->
         <button type="button" class="btn btn-orange delete-btn" data-id="{{ $id }}">
            <i class="fas fa-trash"></i>
         <span class="tooltip">Eliminar</span>
  </button>
   

                
         
  
    </div>

    <!-- FontAwesome CDN -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

