<?php
include_once(dirname(__FILE__)."/../../services/SessionService.php");
validateSession();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Administrador</title>
    
    <link rel="stylesheet" type="text/css" href="../../../public/css/main.css" media="screen" />
</head>
<body>
<div class="nav">
	<a href="employee/index.php" class="nav-button">Catalogo de empleados</a>
	<a href="movie/index.php" class="nav-button">Catalogo de productos</a>
	<a href="cash/index.php" class="nav-button">Corte de caja del d&iacute;a</a>
	<a href="../../services/LoginService.php?logOut" class="exit-button right"><span class="icon fa-off"></a>
</div>
<div class="logo-container center">
	<img alt="" src="../../../public/assets/logo_videoclub_estrella.jpg">
</div>



</body>
</html>