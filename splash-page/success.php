<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Codigo de acceso rapido</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			text-align: center;
			font-family: Verdana, Geneva, sans-serif;
		}

		p {
			color: #999;
			line-height: 20px;
			font-size: 14px;
		}
	</style>
</head>
<body>
	<h1>Código de acceso rápido</h1>
	<img src="<?php echo $base64QrCode ?>">

	<p>
		Presenta este código para el ingreso a nuestro pabellón y disfruta de la gran experiencia AUDI que hemos preparado este año para ti. Descubre novedades y conoce más sobre nuestros vehīculos desde tu teléfono móvil.
    </p>
    
    <a href="<?php echo $signedUrl; ?>">Acceder a Internet</a>
	
</body>
</html>