<?php
include_once(dirname(__FILE__)."/../../services/SessionService.php");
validateSession();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Insert title here</title>
</head>
<body>
<h1>Index de administrador</h1>
<br>
<a href="movie/index.php">Catalogo de productos</a>
<a href="cash/index.php">Corte de caja del d&iacute;a</a>
<br>
<a href="../../services/LoginService.php?logOut">Log Out</a>
</body>
</html>