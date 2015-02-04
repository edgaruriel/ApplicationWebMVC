<?php
include_once(dirname(__FILE__)."/../../../controller/ClientController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");
$controller = new ClientController();
validateSession();
$clients = $controller->getAll();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../../../../public/css/main.css" media="screen" />
</head>
<body>
<div class="nav">
	<a href="../client/index.php" class="nav-button">Catalogo de clientes</a>
	<a href="../cash/index.php" class="nav-button">Corte de caja del d&iacute;a</a>
	<a href="../rentedMovie/index.php" class="nav-button">Rentar pelicula</a>
	<a href="../../../services/LoginService.php?logOut" class="exit-button right"><span class="icon fa-off"></a>
</div>
<div class="container center" >
    <div class="header">Clientes</div>
            <div class="actions">
	            <a href="new.php" class="button right verde"><span class="icon fa-plus"></span>Agregar cliente</a>
	            <a href="../index.php" class="button left azul"><span class="icon fa-home"></span>Regresar</a>
            </div>
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
                                <a href="edit.php?idClient=<?php echo $client->getId();?>"class="s-button verde"><span class="s-icon fa-edit"></span></a>
                                <a href="../../../services/ClientService.php?action=delete&idClient=<?php echo $client->getId();?>"class="s-button rojo"><span class="s-icon fa-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
    
</div>
</body>
</html>