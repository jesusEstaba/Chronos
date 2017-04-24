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
        
        <title>Dashboard @yield('subtitle')</title>
    
        <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">



        <!-- Bootstrap core CSS -->
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
        <link href="{{asset('css/main-dashboard.css')}}" rel="stylesheet">
        
    </head>
    <body>
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right hidden-lg-up collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/dashboard">Dashboard</a>
            <div class="navbar-collapse collapse" id="navbarsExampleDefault" aria-expanded="false">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a id="dashboard" class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>                
                    <p>
                        <b>Proyectos</b>
                    </p>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a id="projects" class="nav-link" href="#">Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a id="schedule" class="nav-link" href="#">Cronograma</a>
                        </li>
                        <li class="nav-item">
                            <a id="clients" class="nav-link" href="#">Clientes</a>
                        </li>
                    </ul>
                    
                    <p>
                        <b>Recursos</b>
                    </p>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a id="partities" class="nav-link" href="#">Partidas</a>
                        </li>
                        <li class="nav-item">
                            <a id="materials" class="nav-link" href="/materials">Materiales</a>
                        </li>
                        <li class="nav-item">
                            <a id="workforce" class="nav-link" href="#">Mano de Obra</a>
                        </li>
                        <li class="nav-item">
                            <a id="employees" class="nav-link" href="#">Trabajadores</a>
                        </li>
                        <li class="nav-item">
                            <a id="equipment" class="nav-link" href="#">Equipos</a>
                        </li>
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
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript">
            $(() => {
               $('.sidebar .nav-link#@yield('activeId')').addClass('active'); 
            });
        </script>

    </body>
</html>