<?php
include_once(dirname(__FILE__)."/../../../services/Date.php");
include_once(dirname(__FILE__)."/../../../controller/CashController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");
$controller = new CashController();
$serviceDate = new DateService();
validateSession();
$arrayMovies = $controller->getMoviesRented();
$total = 0;
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Corte</title>
    <link rel="stylesheet" type="text/css" href="../../../../public/css/main.css" media="screen" />
</head>
<body>
<div class="nav">
	<a href="../employee/index.php" class="nav-button">Catalogo de empleados</a>
	<a href="../movie/index.php" class="nav-button">Catalogo de productos</a>
	<a href="../cash/index.php" class="nav-button">Corte de caja del d&iacute;a</a>
	<a href="../../../services/LoginService.php?logOut" class="exit-button right"><span class="icon fa-off"></span></a>
</div>
<div class="container center">
	<div class="header"><?php echo "Fecha de corte: ".$serviceDate->getDateFormat(Date('Y-m-d'));?></div>
        <div class="actions">
	            <a href="../index.php" class="button left azul"><span class="icon fa-home"></span>Regresar</a>
        </div>
            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Pelicula</th>
                    <th>C&oacute;digo</th>
                    <th>Precio Unitario</th>
                    <th>Unidades rentadas</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($arrayMovies as $movies):?>
                    <?php $units = $movies["units"];?>
                    <?php $movie = $movies["movie"];
                    $totalMovie = $movie->getPrice()*$units;?>
                    <tr>
                        <td><?php echo $movie->getId();?></td>
                        <td><?php echo $movie->getTitle();?></td>
                        <td><?php echo $movie->getCode();?></td>
                        <td><?php echo '$'.number_format($movie->getPrice(),"2");?></td>
                        <td><?php echo $units;?></td>
                        <td><?php echo '$'.number_format($totalMovie,"2");?></td>
                    </tr>
                    <?php $total += $totalMovie;?>
                <?php endforeach;?>
                </tbody>
            </table>

            <h3 class="right"><?php echo "Total: $".number_format($total,'2');?></h3>
			<br><br><br>
</div>
</body>
</html>