<?php
include_once(dirname(__FILE__)."/../../../controller/MovieController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");
include_once(dirname(__FILE__)."/../../../services/MovieService.php");
validateSession();
$movieController = new MovieController();
$id = $_GET["idMovie"];
$movie = $movieController->findOne($id);
$allGender = $movieController->getAllGender();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Pelicula nueva</title>
    <script src="../../../../public/js/admin/movie/edit.js"></script>
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
   <div class="header">Editar Pelicula: <?php echo $movie->getTitle();?></div>
   		<?php if($movie != null):?>
   			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="form" name="form" method="post" enctype="multipart/form-data"  class="form-group">
   					<input type="hidden" id="idMovie" name="idMovie" value="<?php echo $movie->getId();?>"/>
                    <label ><span>Titulo:</span> </label><input type="text" id="title" name="title" value="<?php echo $movie->getTitle();?>"/>

                    <label ><span>Formato: </span></label><input type="text" id="format" name="format" value="<?php echo $movie->getFormat();?>"/>

                    <label ><span>Total de unidades: </span></label><input type="number" id="totalUnits" name="totalUnits" value="<?php echo $movie->getTotalUnits()?>"/>

                    <label ><span>year: </span></label>
                    <select id="year" name="year">
                    <option value="">Seleccione un a&ntilde;o</option>
                    <?php for($i =1980; $i<2015; $i++):?>
                    <?php if($movie->getYear() == $i):?>
                    <option value="<?php echo $i;?>" selected="selected"><?php echo $i;?></option>
                    <?php 
                    continue;
                    endif;?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php endfor;?>                    
                    </select>
  
                    <label ><span>Precio ($): </span></label><input type="number" id="price" name="price" value="<?php echo $movie->getPrice();?>"/>
 
                    <label ><span>C&oacute;digo: </span></label><input type="text" id="code" name="code" value="<?php echo $movie->getCode();?>"/>
 
                    <label ><span>Foto: </span></label><input type="file" id="file_img" name="file_img" value="<?php echo $movie->getPhoto();?>" />

                    <label ><span>Genero: </span></label>
					<select id="gender" name="gender">
                    <option value="">Seleccione un g&eacute;o</option>
                    <?php 
                    foreach ($allGender as $gender):?>
                    <?php if($movie->getGender()->getId() == $gender->getId()):?>
                    <option value="<?php echo $gender->getId();?>" selected="selected"><?php echo $gender->getName();?></option>
                    <?php 
                    continue;
                    endif;?>
                    <option value="<?php echo $gender->getId();?>"><?php echo $gender->getName();?></option>
					<?php endforeach;;?>                    
                    </select>
                    
                    <label ><span>Unidades rentadas: </span></label><input type="number" id="rentedUnits" name="rentedUnits" value="<?php echo $movie->getRentedUnits();?>"/>
                     <br>
                    <br>
                <input type="submit" name="editBtn" id="editBtn" value="Actualizar" class="right verde">
                <a id="btn_cancelar" value="Cancelar" href="index.php" class="button left azul"><span class="icon fa-times"></span>Cancelar</a>
                
            </form>
   		<?php else:?>
   			<h1>Error: La pelicula no existe</h1>
   		<?php endif;?>
<br>
                <br>
                <br>
    </div>

</body>
</html>
