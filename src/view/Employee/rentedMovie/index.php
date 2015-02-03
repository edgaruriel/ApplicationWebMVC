<?php
include_once(dirname(__FILE__)."/../../../controller/RentedMovieController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");

validateSession();
$rentedMovieController = new RentedMovieControoler(); 
$allRented = $rentedMovieController->getAll();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Rentas del d&iacute;a</title>
</head>
<body>
<div >
    <div >
        <div >
            <a value="Agregar" href="new.php">Nueva renta</a>
            <a value="Regresar" href="../index.php">Regresar</a>
            <table style="width:100%" border="1">
                <thead>
                   <tr>
                    <th>Id</th>
                    <th>Pelicula</th>
                    <th>Cliente</th>
                    <th>Unidades rentadas</th>
                    <th>Total</th>
                    <th>Fecha de renta</th>
                    <th>Fecha de devoluci&oacute;n</th>
                    <th>Estatus</th>
                    <th>Operaciones</th>
                </tr>
                </thead>
                <tbody>
                	<?php foreach ($allRented as $rented):?>
                    <tr>
                    	<td><?php echo $rented->getId();?></td>
                    	<td><?php echo $rented->getMovie()->getTitle();?></td>
                    	<td><?php echo $rented->getClient()->getName()." ".$rented->getClient()->getLastName();?></td>
                    	<td><?php echo $rented->getAmount();?></td>
                    	<td><?php echo $rented->getTotal();?></td>
                    	<td><?php echo $rented->getDateRented();?></td>
                    	<td><?php echo $rented->getDateDevolution();?></td>
                    	<td>
                    	<?php if($rented->getIsRented() == Rented::$statusArray["RENTED"]):?>
                    	<strong>RENTADO</strong>
                    	<?php else:?>
                    	<strong>DEVUELTO</strong>
                    	<?php endif;?>
                    	</td>
                    	<td>
                    	<?php if($rented->getIsRented() == Rented::$statusArray["RENTED"]):?>
                    	<form action="../../../services/RentedMovieService.php" method="post">
                    		<input type="hidden" id="action" name="action" value="returnMovie"/>
                    		<input type="hidden" id="idRented" name="idRented" value="<?php echo $rented->getId();?>"/>
                    		<button type="submit">Devolver pelicula</button>
                    	</form>
                    	<?php endif;?>
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