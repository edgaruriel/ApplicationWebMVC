<?php
include_once(dirname(__FILE__)."/../../../controller/EmployeeController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");

validateSession();
$employeeController = new EmployeeController();
$allEmployees = $employeeController->getAll();
$types = $employeeController->getTypes();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Empleados</title>
    
    <link rel="stylesheet" type="text/css" href="../../../../public/css/main.css" media="screen" />
</head>
<body>
<div class="nav">
	<a href="../employee/index.php" class="nav-button">Catalogo de usuarios</a>
	<a href="../movie/index.php" class="nav-button">Catalogo de peliculas</a>
	<a href="../cash/index.php" class="nav-button">Corte de caja del d&iacute;a</a>
	<a href="../../../services/LoginService.php?logOut" class="exit-button right"><span class="icon fa-off"></span></a>
</div>
<div class="container center" >
		<div class="header">Empleados</div>
        <div>
            <div class="actions">
	            <a href="new.php" class="button right verde"><span class="icon fa-plus"></span>Agregar Empleado</a>
	            <a href="../index.php" class="button left azul"><span class="icon fa-home"></span>Regresar</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>OPERACIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allEmployees as $employee):?>
                        <tr>
                            <td><?php echo $employee->getId();?></td>
                            <td><?php echo utf8_encode($employee->getUsername());?></td>
                            <td><?php echo utf8_encode($employee->getName());?></td>
                            <td><?php echo utf8_encode($employee->getLastName());?></td>
                            <td><?php echo utf8_encode($employee->getEmail())?></td>
                            <td>
                            <?php 
                            foreach ($types as $type):
                            	if($type->getId() == $employee->getTypeUser())
                            		echo utf8_encode($type->getName());
                            endforeach;
                            ?>
                            </td>
                            <td>
                                <a href="edit.php?idEmployee=<?php echo $employee->getId();?> " class="s-button verde"><span class="s-icon fa-edit"></span></a>
                                <a href="../../../services/EmployeeService.php?action=delete&idEmployee=<?php echo $employee->getId();?>" class="s-button rojo"><span class="s-icon fa-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
                
            </table>
    </div>
</div>
</body>
</html>

