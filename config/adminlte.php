<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'GEAM',

    'title_prefix' => 'SE',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

//    'logo' => '<b>SEGEAM</b>',
    'logo' => '
                <table>
                    <tr>
                        <td align="left">
                        <img src="/assets/img/inicio.png" alt="logo"  height="40px" width="220px" style="margin-left: -12px; margin-bottom: 6px"></td>
                    </tr>
                </table>
            ',
    'logo_mini' => '<img src="/assets/img/inicio.png" alt="logo"  height="40px" width="220px" style="margin-bottom: 6px; margin-left: 5px;">',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'green',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MENU PRINCIPAL',
        [
            'text' => 'Dashboard',
            'url' => 'home',
            'icon' => 'tachometer',
        ],
         [
             'text' => 'Administrador',
             'url' => 'admin',
             'icon' => 'user',
         ],
        [
            'text' => 'Colaboradores',
            'url' => 'colaborador',
            'icon' => 'users',
        ],
        [
            'text' => 'Clientes',
            'url' => 'cliente',
            'icon' => 'suitcase',
        ],

        [
            'text' => 'Escalas',
            'icon' => 'calendar',
            'url' => 'escala'

        ],
        [
            'text' => 'Unidades',
            'url' => 'unidade',
            'icon' => 'building',
        ],
        [
            'text' => 'Setores',
            'url' => 'setor',
            'icon' => 'sitemap',
        ],

        [
            'text' => 'Cargos',
            'url' => 'cargo',
            'icon' => 'briefcase',
        ],

        [
            'text' => 'Horários',
            'icon' => 'clock-o',
            'submenu' => [
                [
                    'text' => 'Horários de Trabalho',
                    'url' => 'horario-trabalho',

                ],
                [
                    'text' => 'Horários de Intervalo',
                    'url' => 'horario-intervalo',
                ]
            ]
        ],

        [
            'text' => 'Contratos',
            'icon' => 'book',
            'url' => 'contratos'
        ],
        [
            'text' => 'Frequências',
            'icon' => 'check-square-o',
            'submenu' => [
                [
                    'text' => 'Frequência',
                    'url' => 'frequencia',

                ],
                [
                    'text' => 'Relatório',
                    'url' => 'frequencia/inicio-relatorio',

                ],
            ]
        ],
        [
            'text' => 'Feriados',
            'icon' => 'calendar-check-o',
            'url' => 'feriado'
        ],
        [
            'text' => 'Relatórios',
            'icon' => 'file',
            'submenu' => [
                [
                    'text' => 'Colaborador/Setores',
                    'url' => 'relatorio/colaborador-setores',

                ],
            ]
        ],

//        [
//            'text' => 'Blog',
//            'url'  => 'admin/blog',
//            'can'  => 'manage-blog',
//        ],
//        [
//            'text'        => 'Pages',
//            'url'         => 'admin/pages',
//            'icon'        => 'file',
//            'label'       => 4,
//            'label_color' => 'success',
//        ],
//        'ACCOUNT SETTINGS',
//        [
//            'text' => 'Profile',
//            'url'  => 'admin/settings',
//            'icon' => 'user',
//        ],

//        [
//            'text'    => 'Colaboradores',
//            'icon'    => 'users',
//            'submenu' => [
////                [
////                    'text'    => 'Level One',
////                    'url'     => '#',
////                    'submenu' => [
////                        [
////                            'text' => 'Level Two',
////                            'url'  => '#',
////                        ],
////                        [
////                            'text'    => 'Level Two',
////                            'url'     => '#',
////                            'submenu' => [
////                                [
////                                    'text' => 'Level Three',
////                                    'url'  => '#',
////                                ],
////                                [
////                                    'text' => 'Level Three',
////                                    'url'  => '#',
////                                ],
////                            ],
////                        ],
////                    ],
////                ],
//                [
//                    'text' => 'Colaboradores',
//                    'url'  => 'admin/rh/admissao/'
//                ],
//            ],
//        ],
//        'LABELS',
//        [
//            'text'       => 'Important',
//            'icon_color' => 'red',
//        ],
//        [
//            'text'       => 'Warning',
//            'icon_color' => 'yellow',
//        ],
//        [
//            'text'       => 'Information',
//            'icon_color' => 'aqua',
//        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2' => true,
        'chartjs' => true,
    ],
];
