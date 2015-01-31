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
</head>
<body>
<div >
   <div class="container" style="width: 27%; height: auto;">
   		<div style="text-align: right;">
   		<?php if($movie != null):?>
   			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="form" name="form" method="post" enctype="multipart/form-data">
   					<input type="hidden" id="idMovie" name="idMovie" value="<?php echo $movie->getId();?>"/>
                    <label >Titulo: </label><input type="text" id="title" name="title" value="<?php echo $movie->getTitle();?>"/>
                    <br>
                    <label >Formato: </label><input type="text" id="format" name="format" value="<?php echo $movie->getFormat();?>"/>
                    <br>
                    <label >Total de unidades: </label><input type="number" id="totalUnits" name="totalUnits" value="<?php echo $movie->getTotalUnits()?>"/>
                    <br>
                    <label >year: </label>
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
                    <br>
                    <br>
                    <label >Precio ($): </label><input type="number" id="price" name="price" value="<?php echo $movie->getPrice();?>"/>
                    <br>
                    <br>
                    <label >C&oacute;digo: </label><input type="text" id="code" name="code" value="<?php echo $movie->getCode();?>"/>
                    <br>
                    <br>
                    <label >Foto: </label><input type="file" id="file_img" name="file_img" value="<?php echo $movie->getPhoto();?>" />
                    <br>
                    <br>
                    <label >Genero: </label>
					<select id="gender" name="gender">
                    <option value="">Seleccione un a&ntilde;o</option>
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
                    <br>
                    <br>
                    <label >Unidades rentadas: </label><input type="number" id="rentedUnits" name="rentedUnits" value="<?php echo $movie->getRentedUnits();?>"/>
                    <br>
                <input type="submit" name="editBtn" id="editBtn" value="Actualizar">
                <a id="btn_cancelar" value="Cancelar" href="index.php">Cancelar</a>
            </form>
   		<?php else:?>
   			<h1>Error: La pelicula no existe</h1>
   		<?php endif;?>
            </div>
    </div>
</div>
</body>
</html>
