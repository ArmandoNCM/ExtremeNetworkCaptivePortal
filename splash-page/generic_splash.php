<?php
/**
 * This file need the php variables for the principal service, I put the default value, to make test or something like that
 * Julian Bohorquez
 * 25 de Apr 2018
 * 9:16 P.M
 */
?>

<div class="container">
    <div id="login-container" class="succesful-container">
        <div id="header">
            <h1 id="business-name"><?php echo $html_location_name; ?></h1>
        </div>

        <img src="<?php echo $html_location_logo_url; ?>" id="logo">

        <?php
        if (isset($isVerified) && !$isVerified){
            echo '<h3 class="error-message">Por favor recuerde confirmar su dirección de correo</h3><br>';
        }
        ?>
        
        <p id="main-text">
            <?php echo $html_message_content; ?>
        </p>

        <!-- <a href="#" class="btn-send">Cerrar</a> -->

    </div>
</div>