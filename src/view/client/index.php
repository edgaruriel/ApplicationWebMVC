<?php
include_once("../../services/database_access.php");
include_once("../../controller/ClientController.php");
include_once("../../model/Client.php");
include_once("../../services/SessionService.php");
$controller = new ClientController();
validarSesion();
$clients = $controller->getAll();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div >
    <div >
        <div >
            <a value="Agregar" href="new.php">Agregar cliente</a>
            <a value="Regresar" href="../index.php">Regresar</a>
            <table style="width:100%" border="1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>IFE</th>
                        <th>OPERACIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clients as $client):?>
                        <tr>
                            <td><?php echo $client->getId();?></td>
                            <td><?php echo $client->getName();?></td>
                            <td><?php echo $client->getLastName();?></td>
                            <td><?php echo $client->getEmail();?></td>
                            <td><?php echo $client->getIfe();?></td>
                            <td>
                                <a href="edit.php?idClient=<?php echo $client->getId();?>">Editar</a>
                                <a href="../../services/ClientService.php?action=delete&idClient=<?php echo $client->getId();?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>