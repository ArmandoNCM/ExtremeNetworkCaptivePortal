<?php
$html_form_process_url = '/ExtremeNetworksCaptivePortal/splash-page/form_processing.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ExtremeNetworksCaptivePortal/splash-page/assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/ExtremeNetworksCaptivePortal/splash-page/assets/css/anypicker.css" />
    <script type="text/javascript" src="/ExtremeNetworksCaptivePortal/splash-page/assets/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/ExtremeNetworksCaptivePortal/splash-page/assets/js/anypicker.js"></script>
    <script type="text/javascript">
        function setInitialDate(){
            var pickerObject;
            $("#birthdate-input").AnyPicker({onInit: function(){pickerObject = this;},mode: "datetime",dateTimeFormat: "yyyy-MM-dd",minValue: new Date(1940, 00, 01),maxValue: new Date(2010, 11, 31),selectedDate: new Date(2000, 00, 01)});
            pickerObject.showOrHidePicker();
        };
    </script>
</head>
<body>
	<div id="container">
		<img src="/ExtremeNetworksCaptivePortal/splash-page/assets/images/logo.png" id="logo">
		<div class="form-container">
			<h1>Bienvenido</h1>
            <p class="information">Conéctate gratis a nuestra red Wi-Fi en 4 simples pasos</p>
            
            <form method="post" action="<?php echo $html_form_process_url ?>">
                <input name="name" type="text" class="form-control" placeholder="Nombre y apellidos" required>
                <input name="email" type="email" class="form-control" placeholder="Correo electrónico" required>
                <input id="birthdate-input" onclick="setInitialDate()" name="birthdate" type="text" class="form-control" placeholder="Fecha de nacimiento" required readonly>
                <input name="id_number" type="number" class="form-control" placeholder="Documento de identidad" required>
                <input type="submit" class="btn btn-blue">
                
                <?php
                foreach ($hidden_fields_array as $key => $value) {
                    echo "<input type='hidden' name='$key' id='hfv-$key' value='$value' />";
                }
                ?>

                <div id="terms">
                    <input type="checkbox" id="btn-terms" required> <label for="btn-terms">Acepto términos, condiciones, y políticas de privacidad</label>
                </div>
            </form>
		</div>
	</div>
</body>
</html>