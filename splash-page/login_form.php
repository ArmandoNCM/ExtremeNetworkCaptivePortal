<?php
$html_form_process_url = '/ExtremeNetworksCaptivePortal/splash-page/form_processing.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Trinitip Corferias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ExtremeNetworksCaptivePortal/splash-page/assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/ExtremeNetworksCaptivePortal/splash-page/assets/css/anypicker.css" />
    <script type="text/javascript" src="/ExtremeNetworksCaptivePortal/splash-page/assets/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/ExtremeNetworksCaptivePortal/splash-page/assets/js/anypicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#txt-birthdate").AnyPicker({mode: "datetime",dateTimeFormat: "yyyy-MM-dd",minValue: new Date(1940, 00, 01),maxValue: new Date(2010, 11, 31),selectedDate: new Date(2000, 00, 01)});
        });
    </script>
</head>
<body>
<div class="container">

    <div id="login-container" class="captive-portal">
        <div id="header">
            <h1 id="business-name"><?php echo $html_location_name; ?></h1>
        </div>

        <p id="main-text">
            Conéctate gratis a nuestra red Wi-Fi.
        </p>

    </div>

    <div id="login-form">
        <form action="<?php echo $html_form_process_url; ?>" method="post">
            <p>
                <label for="txt-name">Nombre</label>
                <input type="text" class="form-control" name="name" id="txt-name" required>
            </p>
            <p>
                <label for="txt-id-number">Documento de identificación</label>
                <input type="number" class="form-control" name="id_number" id="txt-id-number" required>
            </p>
            <p>
                <label for="txt-email">Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="txt-email" required>
            </p>
            <p>
                <label for="txt-birthdate">Fecha de nacimiento</label>
                <input type="text" class="form-control" name="birthdate" id="txt-birthdate" readonly required>
            </p>
            <p>
                <span>
                    <input style="display: inline" type="checkbox" id="tos-checkbox" required>
                    <label for="tos-checkbox" style="display: inline">
                        Acepto los 
                        <strong><a href="#tos">Términos y Condiciones</a></strong>
                        y
                        <strong><a href="#tos">Políticas de Privacidad</a></strong>
                    </label>
                </span>
            </p>

            <?php
            foreach ($hidden_fields_array as $key => $value) {
                echo "<input type='hidden' name='$key' id='hfv-$key' value='$value' />";
            }
            ?>

            <input type="submit" value="Conectar" class="btn-send">
        </form>
    </div>


</div>
</body>
</html>