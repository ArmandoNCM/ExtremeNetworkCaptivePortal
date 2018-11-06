<?php
$html_form_process_url = '/ExtremeNetworksCaptivePortal/splash-page/form_processing.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/ExtremeNetworksCaptivePortal/splash-page/assets/css/styles.css">
	<title>Conexión Audi</title>
</head>
<body>
	<div id="header">
		<img src="/ExtremeNetworksCaptivePortal/splash-page/assets/images/logo-audi.png">
		<p style="color: white; position: relative; bottom: -50%; text-align: center;">Bienvenido a la nueva era de Audi.</p>
	</div>
	<div id="information">
		<span>Red Wi-Fi gratuita</span>
		<span>Completa el formulario y recibe contenido</span>
		<span>exclusivo de nuestra marca.</span>
	</div>

	<div id="form-container">
		<form action="<?php echo $html_form_process_url ?>" method="post">
			<div class="form-group">
				<span>Primer Nombre</span>
				<input name="first_name" type="text" class="form-control" required>
			</div>
			<div class="form-group">
				<span>Apellido</span>
				<input name="last_name" type="text" class="form-control" required>
			</div>
			<div class="form-group">
				<span>Correo electrónico</span>
				<input name="email" type="email" class="form-control" required>
			</div>
			<div class="form-group">
				<span>Teléfono</span>
				<input  name="phone" type="tel" class="form-control" required>
			</div>
			<div class="form-group">
				<span>Ciudad</span>
				<select name="city" name="" id="" class="select-cities">
					<option value="Bogotá">Bogotá</option>
					<option value="Medellín">Medellín</option>
				</select>
			</div>

			<?php
			foreach ($hidden_fields_array as $key => $value) {
				echo "<input type='hidden' name='$key' id='hfv-$key' value='$value' />";
			}
			?>

			<input type="submit" value="Conectarme" class="btn btn-red">
		</form>
	</div>
    <p id="terms">Al registrarte, aceptas nuestros <a href="#tos">Términos y condiciones</a></p>
    
    <div id="tos">
	
        <h2>Términos y condiciones</h2>
        <br>
        <h3>Aviso Legal</h3>
        Este Sitio Web y las páginas que lo componen han sido diseñadas y creadas para Porsche Colombia S.A.S., distribuidor exclusivo de Audi para la República de Colombia.
        <br>
        Términos y condiciones
        Al acceso y/o uso de este Sitio Web, usted está consintiendo a aceptar que reconoce haber leído y entendido estos Términos y Condiciones y estar de acuerdo con su contenido conforme a la ley colombiana. El uso de cualquier servicio proveído en este Sitio Web, está sujeto a los términos y condiciones aplicables a dicho servicio. Si usted no está de acuerdo con estos términos y condiciones, por favor absténgase de utilizar este Sitio Web.
        <br>
        <h3>Derechos de autor y Propiedad Intelectual</h3>
        Audi AG y Porsche Colombia S.A.S. se reservan todos los derechos de autor y de propiedad industrial. Este Sitio Web, su diseño y los textos, imágenes, gráficos, sonidos, animaciones y videos, y las marcas, logotipos, lemas, slogans y nombres comerciales, son la propiedad intelectual e industrial de Audi AG y/o Porsche Colombia S.A.S. Esta prohibida su reproducción, difusión o distribución para uso comercial, y su contenido no puede ser descargado, modificado, copiado, fijado, insertado o transmitido para fines publicitarios o comerciales. En consecuencia, en ningún evento se otorgará licencia alguna sobre la propiedad intelectual o industrial de Audi AG y/o Porsche Colombia S.A.S. a través de este Sitio Web. Algunas páginas de éste Sitio Web pueden contener material cuyo derecho de autor o propiedad intelectual o industrial pertenezca a terceros.
        <br>
        <h3>Información sobre los productos Volkswagen</h3>
        Toda la información, especificaciones e ilustraciones contenidas en este Sitio Web corresponden a la última actualización disponible al momento de su publicación, por lo que posteriormente pueden haberse producido cambios en relación a los datos que contiene. Los vehículos, equipamientos, equipos opcionales, accesorios, productos y servicios exhibidos o detallados en el Sitio Web, están sujetos a su disponibilidad en la República de Colombia, y pueden no corresponder al equipamiento de serie. Audi AG y/o Porsche Colombia S.A.S. se reservan el derecho de modificar los diseños, los modelos, las especificaciones, los materiales, los equipamientos y los colores en cualquier momento, advirtiendo que dichos cambios pueden incidir sobre los precios, las características o los detalles de los vehículos de Audi AG.
        <br>
        <h3>Garantías de contenido-limitación de responsabilidad</h3>
        Todo el contenido del Sitio Web se ofrece a título meramente informativo e indicativo, procurando que sea lo más preciso, fiel y actual posible, pero sin incluir ningún tipo de garantía, ya sea expresa o implícita. 
        <br>
        La información sobre los modelos y sus características corresponden a los definidos al momento de su publicación o puesta en línea, o el de sus correspondientes actualizaciones, y no debe considerarse como una oferta comercial o contractual de productos o servicios de Audi AG y/o Porsche Colombia S.A.S. o de sus concesionarios. 
        <br>
        En particular, no constituye una garantía tácita o implícita respecto de las características, especificaciones o comerciabilidad de productos, su idoneidad para determinado uso, su adecuación para un propósito particular, el cumplimiento de leyes o la observancia de patentes. 
        <br>
        Audi AG y/o Porsche Colombia S.A.S. no garantizan que las funciones técnicas y de operación del Sitio Web se presenten sin interrupciones o libres de errores, de que dichos defectos sean corregidos, o que este Sitio Web o el servidor que lo hace disponible al público estén libres de virus u otros componentes dañosos. Bajo ninguna circunstancia, Audi AG y/o Porsche Colombia S.A.S. podrán ser obligadas a responder por cualquier clase de daño o perjuicio que resulte del uso del Sitio Web y su contenido. 
        <br>
        El Sitio Web puede a su vez incluir enlaces, vínculos o links a sitios Web externos, cuyos contenidos y diseño son ajenos al control de Audi AG y/o Porsche Colombia S.A.S. En ningún caso nos hacemos responsables por su contenido, actualidad, exactitud o calidad, como que tampoco debe entenderse como el apoyo o la promoción de los productos y/o servicios de terceros, entendiendo que usted emplea el Sitio Web bajo su responsabilidad y dispone de la autonomía y discrecionalidad para decidir respecto de su utilización. Audi AG y/o Porsche Colombia S.A.S. no asumen ninguna responsabilidad por los perjuicios y/o daños directos o indirectos, ciertos o eventuales, pasados, presentes o futuros, pérdida de datos, pérdida de programa o lucro cesante, que resulte del acceso o de la utilización de este Sitio Web o de cualquier sitio Web al que esté vinculado.
        <br>
        Audi AG y/o Porsche Colombia S.A.S. no se hacen responsables por omisiones o errores tipográficos y se reservan el derecho de actualizar, modificar o suprimir el contenido y acceso al Sitio Web y de revisar estos Términos y Condiciones en cualquier momento.
    </div>
</body>
</html>