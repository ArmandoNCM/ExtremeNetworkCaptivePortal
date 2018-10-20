<?php
$html_form_process_url = '/ExtremeNetworksCaptivePortal/splash-page/form_processing.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Conexión Audi</title>
	<style>
		body {
			margin: 0;
			font-family: Verdana, Geneva, sans-serif;
		}

		#header {
			background-image: url('/ExtremeNetworksCaptivePortal/splash-page/assets/images/header-portal.png');
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			padding: 10px;
			height: 150px;
		}

		#information {
			text-align: center;
			font-size: 15px;
			margin-top: 10px;
			margin-bottom: 20px;
		}

		#information span {
			display: block;
		}

		#form-container {
			padding: 10px;
		}

		.form-group {
			margin-bottom: 20px;
		}

		.form-group span {
			display: block;
			font-size: 10px;
		}

		.form-group input[type=text] {

		}

		.form-control {
			border: 0;
			border-bottom: 1px solid #333;
			width: 100%;
		}

		.form-control:focus {
			outline: none;
		}

		.btn-red {
			background-color: #BB0A30;
			width: 100%;
			color: #fff;
			border: 0;
			padding: 10px;
			font-size: 16px;
			font-weight: 100;
		}

		.select-cities {
			width: 100%;
			height: 40px;
			margin-top: 10px;
		}

		#terms {
			text-align: center;
			font-size: 12px;
		}

		#terms a {
			color: #BB0A30;
		}
	</style>
</head>
<body>
	<div id="header">
		<img src="/ExtremeNetworksCaptivePortal/splash-page/assets/images/logo-audi.png">
	</div>
	<div id="information">
		<span>Red Wi-Fi gratuita</span>
		<span>Completa el formulario y recibe contenido</span>
		<span>exclusivo de nuestras marcas</span>
	</div>

	<div id="form-container">
		<form action="<?php echo $html_form_process_url ?>">
			<div class="form-group">
				<span>Nombre</span>
				<input name="name" type="text" class="form-control">
			</div>
			<div class="form-group">
				<span>Correo electrónico</span>
				<input name="email" type="email" class="form-control">
			</div>
			<div class="form-group">
				<span>Teléfono</span>
				<input  name="phone" type="tel" class="form-control">
			</div>
			<div class="form-group">
				<span>Ciudad</span>
				<select name="city" name="" id="" class="select-cities">
					<option value="1">Bogotá</option>
					<option value="2">Medellín</option>
				</select>
			</div>
			<input type="submit" value="Conectarme" class="btn btn-red">
		</form>
	</div>
	<p id="terms">Al registrarte, aceptas nuestros <a href="#">Términos y condiciones</a></p>
</body>
</html>