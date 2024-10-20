<?php

use Svg\Style;

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'MEDFILE',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */
'logo' => '<b>MEDFILE </b>',
'logo_img' => 'vendor/adminlte/dist/img/logomedfile.jpeg',
'logo_img_class' => 'brand-image img-circle elevation-4 bg-primary',
'logo_img_xl' => null,
'logo_img_xl_class' => 'brand-image-xs',
'logo_img_alt' => 'Admin Logo',

   


    'auth_logo' => [
        'enabled' => false,
        'img' => [
        
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-dark',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,  /* su valor era null lo cambie  */
    'layout_fixed_navbar' => true, //lo cambie a true
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null, // lo cambie a true

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => ' bg-orange',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-white',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
   'classes_brand' => 'bg-primary text-white',

    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => ' navbar-darl navbar-dark ',
    'classes_topnav_nav' => 'navbar-expand ',
    'classes_topnav_container' => 'container bg-primary',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 500,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

   'menu' => [
    // Navbar items:
    [
        'type'         => 'fullscreen-widget',
        'topnav_right' => false,
    ],
    [
        'text'       => 'Portal de pacientes',
        'icon_color' => 'white',
        'text_color' => 'dark',
        'route'      => 'medfile-pacientes.home',
        'icon'       => 'fas fa-fw fas fa-user',
        'active'     => ['medfile-pacientes.home'],
    ],

    // Sidebar items:
    [
        'text'       => 'Gestion Pacientes',
        'icon'       => 'fas fa-fw fa-hospital-user',
        'icon_color' => 'white',
        'active'     => ['Pacientes'],
        'submenu'    => [
            [
                'text'       => 'Pacientes Registrados',
                'icon_color' => 'white',
                'text_color' => 'dark',
                'icon'       => 'fas fa-fw fa-hospital-user icon-separation-sidebar',
                'route'      => 'pacientes.index',
                
                'active'     => ['Pacientes*'],
            ],
            [
                'text'       => 'Historias Clínicas',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-file-medical icon-separation-sidebar',
                'route'      => 'historias_clinicas.index',
                'active'     => ['historias_clinicas*'],
            ],
           
            [
                'text'       => 'Registro de Pacientes',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-user-plus icon-separation-sidebar',
                'route'      => 'registro_pacientes.index',
                'active'     => ['registro_pacientes*'],
            ],
            [
                'text'       => 'Hospitales',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-hospital icon-separation-sidebar',
                'route'      => 'hospitales.index',
                'active'     => ['hospitales*'],
            ],
            [
                'text'       => 'Estadisticas  ',
                'icon_color' => 'white',
                'text_color' => 'dark',
                'route'      => 'pacientes.calculos',
                'icon'       => 'fas fa-fw fa-stethoscope',
                'active'     => ['pacientes_calculos'],
            ],
        ],
    ],

    [
        'text'       => 'Gestion emergencias',
        'icon'       => 'fas fa-fw fa-hospital-user',
        'icon_color' => 'white',
        'active'     => ['emergencias'],
        'submenu'    => [
           
            [
                'text'       => 'Emergencias',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-ambulance icon-separation-sidebar',
                'route'      => 'emergencias.index',
                'active'     => ['emergencias*'],
            ],
            [
                'text'       => 'Informes de Condición Diaria',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-notes-medical icon-separation-sidebar',
                'route'      => 'informes_condicion_diaria.index',
                'active'     => ['informes_condicion_diaria*'],
            ],
            [
                'text'       => 'Lista de Problemas',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-exclamation-triangle icon-separation-sidebar',
                'route'      => 'lista_problemas.index',
                'active'     => ['lista_problemas*'],
            ],
            [
                'text'       => 'Notas de Evolución de Tratamiento',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-stethoscope icon-separation-sidebar',
                'route'      => 'notas_evolucion_tratamiento.index',
                'active'     => ['notas_evolucion_tratamiento*'],
            ],
            [
                'text'       => 'Control de Medicamentos',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-pills icon-separation-sidebar',
                'route'      => 'control_medicamentos.index',
                'active'     => ['control_medicamentos*'],
            ],
            [
                'text'       => 'Registro de Admisión Hospitalaria',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-hospital-alt icon-separation-sidebar',
                'route'      => 'registro_admision_hospitalario.index',
                'active'     => ['registro_admision_hospitalario*'],
            ],

        ],
    ],
    [
        'text'       => 'Gestion de Doctores',
        'icon'       => 'fas fa-user-md',
        'icon_color' => 'white',
        'active'     => ['doctores'],
        'submenu'    => [
            [
                'text'       => 'Buscar Doctores',
                'icon_color' => 'white',
                'text_color' => 'dark',
                'route'      => 'doctores.mostrar',
                'icon'       => 'fas fa-fw fa-stethoscope',
                'active'     => ['doctores.mostrar'],
            ],
            [
                'text'       => 'Registro Doctores',
                'icon_color' => 'white',
                'text_color' => 'dark',
                'route'      => 'doctores.index',
                'icon'       => 'fas fa-fw fa-stethoscope',
                'active'     => ['doctores'],
            ],
            
            [
                'text'       => 'Estadisticas  Doctores',
                'icon_color' => 'white',
                'text_color' => 'dark',
                'route'      => 'doctores.calculos',
                'icon'       => ' fa-fw fas fa-chart-line',
                'active'     => ['doctores.calculos'],
            ],

            [
                'text'       => 'Departamentos  Doctores',
                'icon_color' => 'white',
                'text_color' => 'text-dark',
                'color' => 'text-dark',
                'route'      => 'departamentos.index',
                'icon'       => 'fas fa-fw fa-building',
                'active'     => ['departamentos.index'],
                
            ],

            [
                'text'       => 'Especialidades  Doctores',
                'icon_color' => 'white',
                'text_color' => 'dark',
                'route'      => 'especialidades.index',
                'icon'       => 'fas fa-fw fa-user-md',
                'active'     => ['especialidades.index'],
            ],
            [
                'text'       => 'chat IA ',
                'icon_color' => 'white',
                'text_color' => 'dark',
                'route'      => 'chat.medico',
                'icon'       => 'fas fa-fw fa-user-md',
                'active'     => ['chat.medico'],
            ],
        ],
    ],

    [
        'text'       => 'Gestion de Citas',
        'icon'       => 'fas fa-calendar-alt',
        'icon_color' => 'white',
        'active'     => ['citas'],
        'submenu'    => [
            [
                'text'       => 'Registro de citas',
                'icon_color' => 'white',
                'text_color' => 'dark',
                'route'      => 'citas.index',
                'icon'       => 'fas fa-fw fa-calendar-check',
                'active'     => ['citas.index'],
            ],
            [
                'text'       => 'Horarios ',
                'icon_color' => 'white',
                'text_color' => 'dark',
                'route'      => 'horarios-doctor.index',
                'icon'       => 'fas fa-fw  fa-clock',
                'active'     => ['horarios-doctor.index'],
            ],
           
        ],
    ],

    [
        'text'       => 'Opciones de Usuarios',
        'icon'       => 'fas fa-fw fa-heartbeat',
        'icon_color' => 'white',
        'active'     => ['Opciones de cliente'],
        'submenu'    => [
            [
                'text'       => 'Usuarios',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-users',
                'route'      => 'usuarios.index',
                'active'     => ['Usuarios*'],
            ],
            [
                'text'       => 'Roles de usuarios',
                'icon_color' => 'white',
                'icon'       => 'fas fa-fw fa-user-lock',
                'route'      => 'roles.index',
                'active'     => ['roles*'],
            ],
        ],
    ],
],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];