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
</head>
<body>
<div >
   <div class="container" style="width: 27%; height: auto;">
   		<div style="text-align: right;">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="form" name="form" method="post" enctype="multipart/form-data">
                    <label >Titulo: </label><input type="text" id="title" name="title" value="<?php echo (isset($_POST["title"]))? $_POST["title"]: ""?>"/>
                    <br>
                    <label >Formato: </label><input type="text" id="format" name="format" value="<?php echo (isset($_POST["format"]))? $_POST["format"]: ""?>"/>
                    <br>
                    <label >Total de unidades: </label><input type="number" id="totalUnits" name="totalUnits" value="<?php echo (isset($_POST["totalUnits"]))? $_POST["totalUnits"]: ""?>"/>
                    <br>
                    <label >year: </label>
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
                    <br>
                    <br>
                    <label >Precio ($): </label><input type="number" id="price" name="price" value="<?php echo (isset($_POST["price"]))? $_POST["price"]: ""?>"/>
                    <br>
                    <br>
                    <label >C&oacute;digo: </label><input type="text" id="code" name="code" value="<?php echo (isset($_POST["code"]))? $_POST["title"]: ""?>"/>
                    <br>
                    <br>
                    <label >Foto: </label><input type="file" id="file_img" name="file_img"/>
                    <br>
                    <br>
                    <label >Genero: </label>
					<select id="gender" name="gender">
                    <option value="">Seleccione un a&ntilde;o</option>
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
                <input type="submit" name="newBtn" id="newBtn" value="Agregar">
                <a id="btn_cancelar" value="Cancelar" href="index.php">Cancelar</a>
            </form>
            </div>
    </div>
</div>
</body>
</html>
