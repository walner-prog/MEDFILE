<!-- notificaciones/lista.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Notificaciones No Leídas</h3>
    @if($notificaciones->isEmpty())
        <p>No tienes notificaciones pendientes.</p>
    @else
        <ul class="list-group">
            @foreach($notificaciones as $notificacion)
                <li class="list-group-item">
                    {{ $notificacion->data['mensaje'] }} 
                    <span class="badge badge-info">{{ $notificacion->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
