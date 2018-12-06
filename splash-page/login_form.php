<?php
$html_form_process_url = '/ExtremeNetworksCaptivePortal/splash-page/form_processing.php';
$jsonStates = json_decode(file_get_contents(dirname(__FILE__) . '/assets/states.json'), true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ExtremeNetworksCaptivePortal/splash-page/assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/ExtremeNetworksCaptivePortal/splash-page/assets/css/anypicker.css"/>
    <script type="text/javascript"
            src="/ExtremeNetworksCaptivePortal/splash-page/assets/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/ExtremeNetworksCaptivePortal/splash-page/assets/js/anypicker.js"></script>
    <script type="text/javascript">

        // function setInitialDate() {
        //     var pickerObject;
        //     $("#birthdate-input").AnyPicker({
        //         onInit: function () {
        //             pickerObject = this;
        //         },
        //         mode: "datetime",
        //         dateTimeFormat: "yyyy-MM-dd",
        //         minValue: new Date(1940, 00, 01),
        //         maxValue: new Date(2010, 11, 31),
        //         selectedDate: new Date(2000, 00, 30)
        //     });
        //     pickerObject.showOrHidePicker();
        // };

        function disableButton() {
            document.getElementById("submit-button").disabled = true;
        }

        function getCity(state) {
            $.ajax({
                type: "POST",
                url: "/ExtremeNetworksCaptivePortal/splash-page/getCity.php",
                data: 'state=' + state,
                success: function (data) {
                    $("#select-city").html(data);
                }
            });
        }

        $(document).ready(function () {
            getCity("Cundinamarca");
        });
    </script>
</head>
<body>
<div id="container">
    <img src="/ExtremeNetworksCaptivePortal/splash-page/assets/images/header.png" id="logo">
    <h1>Conéctate y disfruta de nuestra red wifi gratis </h1>
    <div class="form-container col-5">
        <form method="post" onsubmit="disableButton()" action="<?php echo $html_form_process_url ?>">
            <input name="name" type="text" class="form-control" placeholder="Nombre y apellidos" required>
            <input name="email" type="email" class="form-control" placeholder="Correo electrónico" required>
            <input name="age" type="number" class="form-control" placeholder="Edad" required>
<!--            <input id="birthdate-input" onclick="setInitialDate()" name="birthdate" type="text" class="form-control"-->
<!--                   placeholder="Fecha de nacimiento" required readonly>-->

            <select id="select-state" name="state" onchange="getCity(this.value)" class="form-control" required>
                <?php
                foreach ($jsonStates as $key => $value) {
                    $name = $value["departamento"];
                    if ($name == 'Cundinamarca') {
                        echo "<option value='$name' selected>$name</option>";
                    } else {
                        echo "<option value='$name'>$name</option>";
                    }
                }
                ?>
            </select>

            <select id="select-city" name="city" class="form-control" required>
            </select>

            <input id="submit-button" type="submit" class="btn btn-blue" placeholder="Registrarse">

            <?php
            foreach ($hidden_fields_array as $key => $value) {
                echo "<input type='hidden' name='$key' id='hfv-$key' value='$value' />";
            }
            ?>

            <div id="terms" align="center">
                <input type="checkbox" id="btn-terms" required>
                <label for="btn-terms">
                    <a href="/ExtremeNetworksCaptivePortal/splash-page/terms_conditions.html" target="_blank"
                       style="color: white">Acepto
                        Términos, condiciones, y
                        políticas de privacidad</a>
                </label>
            </div>
        </form>
    </div>
    <img src="/ExtremeNetworksCaptivePortal/splash-page/assets/images/footer.png" id="footer">
</div>
</body>
</html>