<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--
        <link rel="icon" href="https://v4-alpha.getbootstrap.com/favicon.ico">
        -->
        
        <title>CHRONOS @yield('subtitle')</title>
    
        <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">



        <!-- Bootstrap core CSS -->
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
        <link href="{{asset('css/main-dashboard.css')}}" rel="stylesheet">
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        
        <!-- Global site tag (gtag.js) - Google Analytics 
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109070660-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-109070660-1');
        </script>-->

        <!-- Google Analytics--> 
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-109070660-1', 'none');
            ga('send', 'pageview');
            ga('send', 'screenview');
            ga('send', 'timing');
        </script>
        <!-- End Google Analytics -->

         <!-- Google Tag Manager 
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5W6VKHZ');</script>
 End Google Tag Manager -->
    </head>
    <body>
    <!-- Google Tag Manager (noscript)
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5W6VKHZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
 End Google Tag Manager (noscript) -->
        <nav class="navbar navbar-toggleable-md fixed-top">
            <div class="container-fluid" style="width: 100%;">
                <div class="row" >
                    <div class="col-md-2">
                        <a class="navbar-brand" href="/dashboard">
                            CHRONOS
                        </a>
                    </div>
                    <div class="offset-md-1 col-md-6">
                        <form action="/search" class="form-inline mt-2 mt-md-0">
                            <input style="width: 70%" class="form-control mr-sm-2" type="text" placeholder="Buscar Recursos">
                            <button  class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <a style="float: right;" class="nav-link" href="/logout">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> Salir
                        </a>
                        <a style="float: right;" class="nav-link user-profile">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{Auth::user()->name}}
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a id="dashboard" class="nav-link" href="/dashboard">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                Panel de Control
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a id="projects" class="nav-link" href="/projects">
                                <i class="fa fa-object-group"></i>
                                Proyectos
                            </a>
                        </li>
                        <li class="nav-item" style="display: none;">
                            <a id="schedule" class="nav-link disabled" href="#">
                                <i class="fa fa-calendar-o"></i>
                                Actividades
                            </a>
                        </li>
                        @if(Auth::user()->rol >= 1)
                            <li class="nav-item">
                                <a id="clients" class="nav-link" href="/clients">
                                    <i class="fa fa-address-card-o"></i>
                                    Clientes
                                </a>
                            </li>
                        @endif
                    </ul>
                    <hr>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a id="partities" class="nav-link" href="/partities">
                                <i class="fa fa-folder-open"></i>
                                Partidas
                            </a>
                        </li>
                        @if(Auth::user()->rol >= 1)
                        <li class="nav-item">
                            <a id="materials" class="nav-link" href="/materials">
                                <i class="fa fa-cubes"></i>
                                Materiales
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="equipment" class="nav-link" href="/equipments">
                                <i class="fa fa-wrench"></i>
                                Equipos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="workforce" class="nav-link" href="/workforces">
                                <i class="fa fa-sign-language"></i>
                                Mano de Obra
                            </a>
                        </li>  
                        @endif                      
                    </ul>
                    <hr>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a id="categories" class="nav-link" href="/categories">
                                <i class="fa fa-bookmark-o"></i>
                                Categorias
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="units" class="nav-link" href="/units">
                                <i class="fa fa-tag"></i>
                                Unidades
                            </a>
                        </li>
                        @if(Auth::user()->rol >= 1)
                        <li class="nav-item">
                            <a id="users" class="nav-link " href="/users">
                                <i class="fa fa-users disabled"></i>
                                Usuarios
                            </a>
                        </li><li class="nav-item">
                            <a id="configuration" class="nav-link " href="/configuration">
                                <i class="fa fa-cog"></i>
                                Configuración
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
                    @yield('content')
                </main>
            </div>
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript">
            $(() => {
               $('.sidebar .nav-link#@yield('activeId')').addClass('active'); 
            });
        </script>
    
    <style type="text/css">
            /*
                .dark-primary-color    { background: #F57C00; }
                .default-primary-color { background: #FF9800; }
                .light-primary-color   { background: #FFE0B2; }
                .text-primary-color    { color: #212121; }
                
                .accent-color          { background: #607D8B; }
                
                .primary-text-color    { color: #212121; }
                .secondary-text-color  { color: #757575; }
                .divider-color         { border-color: #BDBDBD; }

            */
            
            
            
            .navbar{
                background: #F57C00 !important;
            }
            .navbar .nav-link{
                color: #FFE0B2 !important;
            }
            .navbar .nav-link:hover{
                color: #fff !important;
            }
            


            .sidebar{
                background: #374046 !important;
            }
            .sidebar .nav-link{
                color: #FF9800;
            }
            .sidebar .nav-link:hover{
                color: #FFE0B2;
            }
            .sidebar .nav-link.disabled{
                color: #757575 !important;
            }
            .sidebar .nav-link.active{
                background: #FF9800 !important;
            }
            .navbar-brand{
                color: #fff !important;
            }
        </style>

  {{--   <style type="text/css">
        
        * {
            background: none !important;
            color: initial !important;
            border-radius: initial !important;
            box-shadow: none !important;
            font-family: serif !important;
            border-color: black !important;
            font-size: initial !important;
            font-weight: initial !important;
        }

        h2{
            font-size: 2em !important;
        }
        h3{
            font-size: 1.6em !important;
        }
        h4{
            font-size: 1.3em !important;
        }

        a {
            text-decoration: underline !important;
        }

        .btn, [data-toggle="tab"]{
            background: #000 !important;
            color: #fff !important;
            text-decoration: none !important;
            border:1px solid white !important;
        }
        nav {
            background: #fff !important;
        }
        nav, .sidebar, .tab-content{
            border:1px solid #000 !important;
        }
        .fa {
            display: none !important; 
        }
        .user-profile{
            text-decoration: none !important;
        }
        input{
            font-family: serif !important;
        }
        .tab-content .table thead th{
            font-size: .8em !important;
        }

    </style> --}}

    </body>
</html>