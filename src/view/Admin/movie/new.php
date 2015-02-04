<?php
include_once(dirname(__FILE__)."/../../../controller/MovieController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");
include_once(dirname(__FILE__)."/../../../services/MovieService.php");
validateSession();

$movieController = new MovieController();
$allGender = $movieController->getAllGender();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Pelicula nueva</title>
    <script src="../../../../public/js/admin/movie/new.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../../public/css/main.css" media="screen" />
</head>
<body>
<div class="nav">
	<a href="../employee/index.php" class="nav-button">Catalogo de usuarios</a>
	<a href="../movie/index.php" class="nav-button">Catalogo de peliculas</a>
	<a href="../cash/index.php" class="nav-button">Corte de caja del d&iacute;a</a>
	<a href="../../../services/LoginService.php?logOut" class="exit-button right"><span class="icon fa-off"></a>
</div>

   <div class="container center">
   <div class="header">Nuevo Pelicula</div>

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="form" name="form" method="post" enctype="multipart/form-data" class="form-group">
                    <label ><span>Titulo: </span></label><input type="text" id="title" name="title" value="<?php echo (isset($_POST["title"]))? $_POST["title"]: ""?>"/>
                    
                    <label ><span>Formato: </span></label><input type="text" id="format" name="format" value="<?php echo (isset($_POST["format"]))? $_POST["format"]: ""?>"/>
                    
                    <label ><span>Total de unidades: </span></label><input type="number" id="totalUnits" min="1" name="totalUnits" value="<?php echo (isset($_POST["totalUnits"]))? $_POST["totalUnits"]: ""?>"/>
                    
                    <label ><span>A&ntilde;o: </span></label>
                    <select id="year" name="year">
                    <option value="">Seleccione un a&ntilde;o</option>
                    <?php for($i =1980; $i<2015; $i++):?>
                    <?php if(isset($_POST["year"]) && $_POST["year"] == $i):?>
                    <option value="<?php echo $i;?>" selected="selected"><?php echo $i;?></option>
                    <?php 
                    continue;
                    endif;?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php endfor;?>                    
                    </select>
                    <input type="hidden" value="<?php echo (isset($_POST["year"]))? $_POST["year"]:'';?>"/>

                    <label ><span>Precio ($): </span></label><input type="number" min="1" id="price" name="price" value="<?php echo (isset($_POST["price"]))? $_POST["price"]: ""?>"/>

                    <label ><span>C&oacute;digo: </span></label><input type="text" id="code" name="code" value="<?php echo (isset($_POST["code"]))? $_POST["title"]: ""?>"/>

                    <label ><span>Foto: </span></label><input type="file" id="file_img" name="file_img"/>

                    <label ><span>Genero: </span></label>
					<select id="gender" name="gender">
                    <option value="">Seleccione un g&eacute;nero</option>
                    <?php foreach ($allGender as $gender):?>
                    <?php if(isset($_POST["gender"]) && $_POST["gender"] == $gender->getId()):?>
                    <option value="<?php echo $gender->getId();?>" selected="selected"><?php echo $gender->getName();?></option>
                    <?php 
                    continue;
                    endif;?>
                    <option value="<?php echo $gender->getId();?>"><?php echo $gender->getName();?></option>
					<?php endforeach;;?>                    
                    </select>
                    <br>
                    <br>
                <input type="submit" name="newBtn" id="newBtn" value="Agregar" class="right verde">
                <a id="btn_cancelar" value="Cancelar" href="index.php" class="button left azul"><span class="icon fa-times"></span>Cancelar</a>
                <br>
                <br>
                <br>
            </form>
    </div>

</body>
</html>
