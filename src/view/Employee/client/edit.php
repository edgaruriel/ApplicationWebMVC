<?php
include_once(dirname(__FILE__)."/../../../controller/ClientController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");
include_once(dirname(__FILE__)."/../../../services/ClientService.php");
validateSession();
$controller = new ClientController();
$id = $_GET["idClient"];
$client = $controller->findOne($id);
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="../../../../public/js/employee/client/edit.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../../public/css/main.css" media="screen" />
</head>
<body>
<div class="nav">
	<a href="../employee/index.php" class="nav-button">Catalogo de empleados</a>
	<a href="../movie/index.php" class="nav-button">Catalogo de productos</a>
	<a href="../cash/index.php" class="nav-button">Corte de caja del d&iacute;a</a>
	<a href="../../../services/LoginService.php?logOut" class="exit-button right"><span class="icon fa-off"></a>
</div>
<div class="container center">
	<div class="header">Editar: <?php echo $client->getName();?></div>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="form" name="form" method="post" class="form-group">
                <input type="hidden" id="idClient" name="idClient" value="<?php echo $client->getId();?>">
                
                    <label ><span>Nombre: </span></label><input type="text" id="name" name="name" value="<?php echo $client->getName();?>"/>

                    <label ><span>Apellido(s): </span></label><input type="text" id="last_name" name="last_name" value="<?php echo $client->getLastName();?>"/>

                    <label ><span>Correo: </span></label><input type="text" id="email" name="email" value="<?php echo $client->getEmail();?>"/>

                    <label ><span>IFE: </span></label><input type="text" id="ife" name="ife" value="<?php echo $client->getIfe();?>"/>
                <br>
                <input type="submit" name="editBtn" id="editBtn" value="Actualizar" class="right verde">
                <a id="btn_cancelar" value="Cancelar" href="index.php" class="button left azul"><span class="icon fa-times"></span>Cancelar</a>
            </form>
	<br><br><br>
</div>
</body>
</html>