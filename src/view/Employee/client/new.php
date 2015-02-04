<?php
include_once(dirname(__FILE__)."/../../../controller/ClientController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");
include_once(dirname(__FILE__)."/../../../services/ClientService.php");
validateSession();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="../../../../public/js/employee/client/new.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../../public/css/main.css" media="screen" />
</head>
<body>
<div class="nav">
	<a href="../client/index.php" class="nav-button">Catalogo de clientes</a>
	<a href="../cash/index.php" class="nav-button">Corte de caja del d&iacute;a</a>
	<a href="../rentedMovie/index.php" class="nav-button">Rentar pelicula</a>
	<a href="../../../services/LoginService.php?logOut" class="exit-button right"><span class="icon fa-off"></span></a>
</div>
<div class="container center">
    <div class="header">Nuevo Cliente</div>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="form" name="form" method="post" class="form-group">

                    <label ><span>Nombre: </span></label><input type="text" id="name" name="name"/>

                    <label ><span>Apellido(s): </span></label><input type="text" id="last_name" name="last_name"/>

                    <label ><span>Correo: </span></label><input type="text" id="email" name="email"/>

                    <label ><span>IFE: </span></label><input type="text" id="ife" name="ife"/>
				<br>
                <input type="submit" name="newBtn" id="newBtn" value="Agregar" class="right verde">
                <a id="btn_cancelar" value="Cancelar" href="index.php"class="button left azul"><span class="icon fa-times"></span>Cancelar</a>
            </form>
     <br><br><br>
</div>
</body>
</html>