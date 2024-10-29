<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio Sesión</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('_login/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('_login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('_login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('_login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('_login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('_login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('_login/css/main.css')}}">
<!--===============================================================================================-->
	 <!--alertify-->
	 <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.core.css')}}">
	 <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.default.css')}}">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					
					<img src="{{asset('_login/images/fge.png')}}" alt="IMG">
					
				</div>

				<form class="login100-form validate-form" method="post" action="{{ route('login') }}" autocomplete="off">
					{{ csrf_field() }}
					<span class="login100-form-title" style="color:#fff">
						SISTEMA CADENA DE CUSTODIA
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" placeholder="Usuario" required value="{{old('folio')}}" name="folio">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" placeholder="Contraseña" required name="password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Iniciar
						</button>
					</div>
<!--
					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
-->
				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="{{asset('_login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('plugins/jQuery/jquery-migrate-1.4.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('_login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('_login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('_login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('_login/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<!--alertify-->
	<script src="{{asset('plugins/alertify/js/alertify.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('_login/js/main.js')}}"></script>
	<script src="{{asset('js/navegador/navegador_mozilla.js')}}"></script>
	<script src="{{asset('js/navegador/navegador_internet_explorer.js')}}"></script>

</body>
</html>
