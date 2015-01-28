<?php
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="../../../public/js/client/client.js"></script>
</head>
<body>
<div >
    <div >
        <div >
            <form action="../../services/ClientService.php" id="form" name="form" method="post">
                <div >
                    <label >Nombre: </label><input type="text" id="name" name="name"/>
                </div>
                <div >
                    <label >Apellido(s): </label><input type="text" id="last_name" name="last_name"/>
                </div>
                <div >
                    <label >Correo: </label><input type="text" id="email" name="email"/>
                </div>
                <div >
                    <label >IFE: </label><input type="text" id="ife" name="ife"/>
                </div>
                <input type="submit" name="newBtn" id="newBtn" value="Agregar">
                <a id="btn_cancelar" value="Cancelar" href="index.php">Cancelar</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>