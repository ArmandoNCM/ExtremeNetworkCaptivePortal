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
			margin-top: 30px;
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
			font-size: 12px;
		}

		.form-group input[type=text] {

		}

		.form-control {
            margin-top: 10px;
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

        #tos {
            margin-top: 50px;
            font-size: 12px;
            padding: 10px;
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
    <p id="terms">Al registrarte, aceptas nuestros <a href="#tos">Términos y condiciones</a></p>
    
    <p id="tos">

        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ornare orci et purus dignissim finibus. Mauris facilisis eros quam, quis laoreet nibh porta eu. Nullam lacinia mattis sollicitudin. Ut lobortis tellus ultricies iaculis suscipit. Sed nec scelerisque turpis, vitae mollis neque. Sed dictum mauris quis quam congue ullamcorper. Aliquam vitae vehicula dui. Quisque nec molestie dui, nec rhoncus purus.
        <br>
        <br>
        Vestibulum sit amet volutpat odio. Vivamus vestibulum lectus fermentum, scelerisque nulla ut, volutpat ante. Nunc accumsan finibus orci at auctor. Aliquam erat volutpat. Aenean in metus eget lectus vulputate maximus id nec velit. Praesent faucibus nisl sit amet eros suscipit tempor. Duis molestie scelerisque augue nec faucibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec hendrerit augue placerat odio commodo, nec dictum orci fermentum. Sed id leo pharetra, volutpat nunc eu, auctor ligula.
        <br>
        <br>
        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In diam libero, scelerisque placerat vulputate in, mollis eget nisi. Nunc laoreet ante est, et porta sapien volutpat ut. Nunc eu purus maximus, finibus eros sed, dignissim erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque eget finibus elit. Ut in dolor sit amet lectus consequat faucibus vitae at elit. Donec laoreet ante vitae augue imperdiet fermentum. Etiam consequat lorem a nisi tincidunt, sed vehicula enim tempus.
    </p>
</body>
</html>