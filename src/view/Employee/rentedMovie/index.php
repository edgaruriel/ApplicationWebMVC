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
    <div class="header">Rentas</div>
            <div class="actions">
	            <a href="new.php" class="button right verde"><span class="icon fa-plus"></span>Nueva renta</a>
	            <a href="../index.php" class="button left azul"><span class="icon fa-home"></span>Regresar</a>
            </div>
            <table style="width:100%" border="1">
                <thead>
                   <tr>
                    <th>Id</th>
                    <th>Pelicula</th>
                    <th>Cliente</th>
                    <th>Cantidad</th>
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
                    	<strong class="rentado">RENTADO</strong>
                    	<?php else:?>
                    	<strong class="devuelto">DEVUELTO</strong>
                    	<?php endif;?>
                    	</td>
                    	<td>
                    	<?php if($rented->getIsRented() == Rented::$statusArray["RENTED"]):?>
                    	<form action="../../../services/RentedMovieService.php" method="post">
                    		<input type="hidden" id="action" name="action" value="returnMovie"/>
                    		<input type="hidden" id="idRented" name="idRented" value="<?php echo $rented->getId();?>"/>
                    		<button type="submit" class="verde">Devolver</button>
                    	</form>
                    	<?php endif;?>
                    	</td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

</div>
</body>
</html>