<?php
include_once("../../controller/ClientController.php");
include_once("../../services/SessionService.php");
validarSesion();
$id = $_GET["idClient"];
$client = findOne($id);
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="../../../public/js/client/edit.js"></script>
</head>
<body>
<div >
    <div >
        <div >
            <form action="../../services/ClientService.php" id="form" name="form" method="post">
                <input type="hidden" id="idClient" name="idClient" value="<?php echo $client->getId();?>">
                <div >
                    <label >Nombre: </label><input type="text" id="name" name="name" value="<?php echo $client->getName();?>"/>
                </div>
                <div >
                    <label >Apellido(s): </label><input type="text" id="last_name" name="last_name" value="<?php echo $client->getLastName();?>"/>
                </div>
                <div >
                    <label >Correo: </label><input type="text" id="email" name="email" value="<?php echo $client->getEmail();?>"/>
                </div>
                <div >
                    <label >IFE: </label><input type="text" id="ife" name="ife" value="<?php echo $client->getIfe();?>"/>
                </div>
                <input type="submit" name="editBtn" id="editBtn" value="Actualizar">
                <a id="btn_cancelar" value="Cancelar" href="index.php">Cancelar</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>