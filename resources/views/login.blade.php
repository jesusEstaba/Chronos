<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--
    <link rel="icon" href="../../favicon.ico">
	-->

    <title>Inicia Sesión</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style type="text/css">
		body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}

		.form-signin {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signin .form-signin-heading,
		.form-signin .checkbox {
		  margin-bottom: 10px;
		}
		.form-signin .checkbox {
		  font-weight: normal;
		}
		.form-signin .form-control {
		  position: relative;
		  height: auto;
		  -webkit-box-sizing: border-box;
		          box-sizing: border-box;
		  padding: 10px;
		  font-size: 16px;
		}
		.form-signin .form-control:focus {
		  z-index: 2;
		}
		.form-signin input[type="email"] {
		  margin-bottom: -1px;
		  border-bottom-right-radius: 0;
		  border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
    </style>
</head>


<body>
	<div class="container">
	<div class="notifications">
		@if (session()->has('message'))
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			  <strong>{{session()->get('message')}}.</strong> 
			</div>
		@endif
	</div>
	

      <form class="form-signin" style="margin-top: 3em;" method="post">
      	<img class="img-fluid" style="margin-bottom: 3em;" src="{{asset('images/logos/j1atjjNo.png')}}" alt="">
      	{{ csrf_field() }}
        <p class="m-0">
        	<small>Inicie sesión para continuar</small>
        </p>
        <label for="inputEmail" class="sr-only">Correo</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Correo" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required="">
        <div class="hidden-xs-up checkbox">
          <label>
            <input name="remember-me" type="checkbox" value="remember-me"> Recuérdame
          </label>
        </div>
        <button style="cursor: pointer;" class="btn btn-lg btn-outline-primary btn-block" type="submit">Entrar</button>
      </form>

    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>