@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')

    <link rel="stylesheet" href="{{ asset('full-calendar/es.ts') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-<hash>" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Preloader Animation --}}
        {{-- Si no estás utilizando un preloader, puedes eliminar este bloque --}}
        {{-- @if($layoutHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif --}}

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
@stop


<script>
    document.addEventListener('DOMContentLoaded', function () {
    function showAlert(message, icon, type) {
        Swal.fire({
            title: message,
            icon: icon,
            toast: true, // Habilita el modo toast
            position: 'top-end', // Posición en la esquina superior derecha
            showConfirmButton: false, // Oculta el botón de confirmar
            timer: 7000, // El mensaje desaparecerá después de 7 segundos
            timerProgressBar: true, // Muestra la barra de progreso
            customClass: {
                popup: 'custom-swal-toast', // Clase CSS personalizada
            }
        });
    }


    @if(session('info'))
        showAlert('{{ session('info') }}', 'success', 'success');
    @endif

    @if(session('update'))
        showAlert('{{ session('update') }}', 'info', 'info');
    @endif

    @if(session('delete'))
        showAlert('{{ session('delete') }}', 'error', 'error');
    @endif

    @if(session('error'))
        showAlert('{{ session('error') }}', 'error', 'error');
    @endif
});

</script>
