<?php
include_once(dirname(__FILE__)."/../../../controller/MovieController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");

validateSession();
$movieController = new MovieController();
$allMovie = $movieController->getAll();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="../../../../public/js/admin/movie/index.js"></script>
</head>
<body onload="refresh();">
<div class="container" >
	<input type="hidden" id="idRefresh" name="idRefresh" value="<?php echo (isset($_GET["refresh"]))? $_GET["refresh"]: "";?>"/>
        <div>
            <a href="new.php">Agregar Pelicula</a>
            <a href="../index.php">Regresar</a>
            <table style="" border="1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Disponibles</th>
                        <th>Precio</th>
                        <th>Genero</th>
                        <th>OPERACIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allMovie as $movie):?>
                        <tr>
                            <td><?php echo $movie->getId();?></td>
                            <td><?php echo utf8_encode($movie->getTitle());?></td>
                            <?php $available = ($movie->getTotalUnits()) - ($movie->getRentedUnits());?>
                            <td><?php echo $available;?></td>
                            <td><?php echo '$'.$movie->getPrice();?></td>
                            <td><?php echo utf8_encode($movie->getGender()->getName());?></td>
                            <td>
                                <a href="edit.php?idMovie=<?php echo $movie->getId();?>">Editar</a>
                                <a href="../../../services/MovieService.php?action=delete&idMovie=<?php echo $movie->getId();?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
    </div>
</div>
</body>
</html>

