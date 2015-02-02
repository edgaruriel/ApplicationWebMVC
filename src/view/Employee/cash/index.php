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
    <title></title>
</head>
<body>
<div >
    <div >
        <div >
            <a value="Regresar" href="../index.php">Regresar</a>
            <h3><?php echo "Fecha de corte: ".$serviceDate->getDateFormat(Date('Y-m-d'));?></h3>
            <table style="width:100%" border="1">
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

            <h3><?php echo "Total: $".number_format($total,'2');?></h3>
        </div>
    </div>
</div>
</body>
</html>