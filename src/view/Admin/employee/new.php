<?php
include_once(dirname(__FILE__)."/../../../controller/EmployeeController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");
include_once(dirname(__FILE__)."/../../../services/EmployeeService.php");
validateSession();
$controller = new EmployeeController();
$types = $controller->getTypes();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Nuevo</title>
    <script src="../../../../public/js/admin/user/new.js"></script>
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
	<div class="header">Nuevo Empleado</div>
        <div >
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="form" name="form" method="post" class="form-group">
                 
                    <label ><span>Nombre de usuario:</span></label><input type="text" id="username" name="username"/>

                    <label ><span>Contrase&ntilde;a: </span></label><input type="password" id="password" name="password"/>
                
                    <label ><span>Nombre: </span></label><input type="text" id="name" name="name"/>

                    <label ><span>Apellido(s): </span></label><input type="text" id="last_name" name="last_name""/>
                
                    <label ><span>Correo: </span></label><input type="text" id="email" name="email"/>
                
                <label ><span>Tipo: </span>
					<select id="tipo" name="tipo">
                    <option value="">Seleccione un tipo</option>
                    <?php 
                    foreach ($types as $type):?>
                    <option value="<?php echo $type->getId();?>"><?php echo $type->getName();?></option>
				<?php endforeach;;?>                    
                    </select>
                    </label>
                <input type="submit" name="newBtn" id="newBtn" value="Agregar" class="right verde">
                <a id="btn_cancelar" value="Cancelar" href="index.php" class="button left azul"><span class="icon fa-times"></span>Cancelar</a>
                <br>
                <br>
                <br>
            </form>
        </div>

</div>
</body>
</html>