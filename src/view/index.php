<?php
include_once ("../services/HeaderService.php");
include_once("../services/SessionService.php");
error_reporting(0);
validarSesion();
?>
<div id="div_encabezado">
    <div id="div_menu" >
        <?php
        echo listarMenu();
        ?>
    </div>
</div>
