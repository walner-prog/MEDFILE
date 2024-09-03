@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.usermenu_profile_url', false))
    @php( $profile_url = Auth::user()->adminlte_profile_url() )
@endif

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

       {{-- Aca estoy mostrando el nombre del uduario y su perfil y las notificaciones  --}}
         {{-- icono notificaciones  --}}
                              <!-- Nav Item - Alerts -->


                              <div class="row">
                                <div class="col-lg-2">
                                   
                                </div>
                        
                               
                                <div class="col-lg-6   text-right mr-auto">
                                 
                                   
                                </div>
                                <div class="col-lg-2 d-flex justify-content-end align-items-center">
                                    <div class="datetime badge bagge-datetime text-white p-2 mr-2" id="datetime"></div>
                                    <label class="switch mb-0">
                                        <input type="checkbox" id="theme-toggle">
                                        <span class="slider round">
                                            <i class="fas fa-sun icon-light"></i>
                                            <i class="fas fa-moon icon-dark"></i>
                                        </span>
                                        <span id="mode-text" class="visually-hidden" style="visibility: hidden"></span>
                                    </label>
                                </div>
                                
                             </div>
    <ul class="navbar-nav ml-auto">
                             
                                           
                            
<li class="nav-item dropdown user-menu">

    {{-- User menu toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if(config('adminlte.usermenu_image'))
            <img src="{{ Auth::user()->adminlte_image() }}"
                 class="user-image img-circle elevation-2"
                 alt="{{ Auth::user()->name }}">
        @endif
        <span @if(config('adminlte.usermenu_image')) class="d-none d-md-inline text-dark"
              @endif>
            {{ Auth::user()->name }}
            @if(Auth::user()->profile_photo)
            <img src="{{ asset('images/' . Auth::user()->profile_photo) }}" alt="Foto de Perfil" class="rounded-circle" width="40" height="40"> 
             @else
            <i class="fa fa-user-circle"></i>
              @endif
        </span>
    </a>

    {{-- User menu dropdown --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right mb-2 mr-1 ml-1">

        {{-- User menu header --}}
        @if(!View::hasSection('usermenu_header') && config('adminlte.usermenu_header'))
            <li class="user-header {{ config('adminlte.usermenu_header_class', 'bg-primary') }}
                @if(!config('adminlte.usermenu_image')) h-auto @endif">
                @if(config('adminlte.usermenu_image'))
                    <img src="{{ Auth::user()->adminlte_image() }}"
                         class="img-circle elevation-2"
                         alt="{{ Auth::user()->name }}">
                @endif
                <p class="@if(!config('adminlte.usermenu_image')) mt-0 @endif">
                    {{ Auth::user()->name }}
                    @if(config('adminlte.usermenu_desc'))
                        <small>{{ Auth::user()->adminlte_desc() }}</small>
                    @endif
                </p>
            </li>
        @else
            @yield('usermenu_header')
        @endif

        {{-- Configured user menu links --}}
        @each('adminlte::partials.navbar.dropdown-item', $adminlte->menu("navbar-user"), 'item')

        {{-- User menu body --}}
        @hasSection('usermenu_body')
            <li class="user-body">
                @yield('usermenu_body')
            </li>
        @endif

        {{-- User menu footer --}}
        <li class="user-footer">
            @if($profile_url)
                <a href="{{ $profile_url }}" class="btn btn-default btn-flat">
                    <i class="fa fa-fw fa-user text-lightblue"></i>
                    {{ __('adminlte::menu.profile') }}
                </a>
            @endif
            <a class="btn btn-default btn-float float-right w-50  @if(!$profile_url) btn-block btn-dark @endif"
               href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off text-red"></i>
                {{ __('Cerrar') }}
            </a>
            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                @if(config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
          
            <a class="btn btn-default btn-float float-right btn-block btn-dark w-50 " href="{{ route('profile') }}">
                <i class="fas fa-fw fa-eye text-gray"></i> Mi Perfil</a>
                
        </li>

    </ul>

</li>

 <script>
    

document.addEventListener("DOMContentLoaded", function () {
    const toggleSwitch = document.getElementById('theme-toggle');
    const modeText = document.getElementById('mode-text');
    const breadcrumb = document.getElementById('breadcrumb');
  
    function switchTheme(e) {
      if (e.target.checked) {
        // Tema oscuro
        document.documentElement.classList.add('dark-mode');
        document.documentElement.classList.remove('light-mode');
        modeText.textContent = 'modo claro';
        breadcrumb.classList.remove('bg-white', 'text-light');
        breadcrumb.classList.add('bg-dark', 'text-white');
        localStorage.setItem('theme', 'dark'); // Guardar la preferencia en localStorage
      } else {
        // Tema claro
        document.documentElement.classList.add('light-mode');
        document.documentElement.classList.remove('dark-mode');
        modeText.textContent = 'modo oscuro';
        breadcrumb.classList.remove('bg-dark', 'text-white');
        breadcrumb.classList.add('bg-white', 'text-light');
        localStorage.setItem('theme', 'light'); // Guardar la preferencia en localStorage
      }
    }
  
    // Aplicar el tema guardado en localStorage al cargar la página
    const currentTheme = localStorage.getItem('theme');
  
    if (currentTheme === 'dark') {
      toggleSwitch.checked = true;
      document.documentElement.classList.add('dark-mode');
      document.documentElement.classList.remove('light-mode');
      modeText.textContent = 'modo claro';
      breadcrumb.classList.remove('bg-white', 'text-light');
      breadcrumb.classList.add('bg-dark', 'text-white');
    } else if (currentTheme === 'light') {
      toggleSwitch.checked = false;
      document.documentElement.classList.add('light-mode');
      document.documentElement.classList.remove('dark-mode');
      modeText.textContent = 'modo oscuro';
      breadcrumb.classList.remove('bg-dark', 'text-white');
      breadcrumb.classList.add('bg-white', 'text-light');
    }
  
    // Event listener para el cambio de tema
    toggleSwitch.addEventListener('change', switchTheme);
  });
  
  
  // Function to update date and time
  function updateDateTime() {
      const now = new Date();
      const datetimeString = now.toLocaleString();
      document.getElementById('datetime').textContent = datetimeString;
  }
  
  
  // Initial call to set the date and time
  updateDateTime();
  
  // Update date and time every second
  setInterval(updateDateTime, 1000);
  
 </script>
  
         

