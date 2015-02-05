<?php
include_once(dirname(__FILE__)."/../services/database_access.php");
include_once(dirname(__FILE__)."/../services/SessionService.php");
include_once(dirname(__FILE__)."/../model/Client.php");

class ClientController
{
    function getAll()
    {
        $array = array();
        //Conexion con el servidor de base de datos
        $pconexion = abrirConexion();
        //Seleccion de la base de datos
        seleccionarBaseDatos($pconexion);
        //Construccion de la sentencia SQL
        $cquery = "SELECT client.id AS id_client, client.name AS name, ";
        $cquery .= "client.last_name AS last_name, ";
        $cquery .= "client.email AS email, ";
        $cquery .= "client.ife AS ife ";
        $cquery .= "FROM client ";
        $cquery .= "WHERE client.status = 1";
        //Se ejecuta la sentencia SQL
        $lresult = mysqli_query($pconexion, $cquery);

        if (!$lresult) {
            $cerror = "No fue posible recuperar la informacion de la base de datos.<br>";
            $cerror .= "SQL: $cquery <br>";
            $cerror .= "Descripcion: " . mysqli_connect_error($pconexion);
            die($cerror);
        } else {
            //Verifica que la consulta haya devuelto por lo menos un registro
            if (mysqli_num_rows($lresult) > 0) {
                while ($adatos = mysqli_fetch_array($lresult, MYSQLI_BOTH)) {
                    $client = new Client();
                    $client->setId($adatos["id_client"]);
                    $client->setName($adatos["name"]);
                    $client->setLastName($adatos["last_name"]);
                    $client->setEmail($adatos["email"]);
                    $client->setIfe($adatos["ife"]);
                    array_push($array, $client);
                }
            }
        }
        mysqli_free_result($lresult);

        cerrarConexion($pconexion);
        return $array;
    }

    function findOneByEmail($email)
    {
        $client = new Client();
        //Conexion con el servidor de base de datos
        $pconexion = abrirConexion();
        //Seleccion de la base de datos
        seleccionarBaseDatos($pconexion);
        //Construccion de la sentencia SQL
        $cquery = "SELECT client.id AS id_client, client.name AS name, ";
        $cquery .= "client.last_name AS last_name, ";
        $cquery .= "client.email AS email, ";
        $cquery .= "client.ife AS ife ";
        $cquery .= "FROM client ";
        $cquery .= "WHERE client.email = '" .$email."'";
        //Se ejecuta la sentencia SQL
        $lresult = mysqli_query($pconexion, $cquery);

        if (!$lresult) {
            $cerror = "No fue posible recuperar la informacion de la base de datos.<br>";
            $cerror .= "SQL: $cquery <br>";
            $cerror .= "Descripcion: " . mysqli_connect_error($pconexion);
            die($cerror);
        } else {
            //Verifica que la consulta haya devuelto por lo menos un registro
            if (mysqli_num_rows($lresult) > 0) {
                while ($adatos = mysqli_fetch_array($lresult, MYSQLI_BOTH)) {

                    $client->setId($adatos["id_client"]);
                    $client->setName($adatos["name"]);
                    $client->setLastName($adatos["last_name"]);
                    $client->setEmail($adatos["email"]);
                    $client->setIfe($adatos["ife"]);
                }
            }
        }
        mysqli_free_result($lresult);

        cerrarConexion($pconexion);
        return $client;
    }

    function findOne($id)
    {
        $client = new Client();
        //Conexion con el servidor de base de datos
        $pconexion = abrirConexion();
        //Seleccion de la base de datos
        seleccionarBaseDatos($pconexion);
        //Construccion de la sentencia SQL
        $cquery = "SELECT client.id AS id_client, client.name AS name, ";
        $cquery .= "client.last_name AS last_name, ";
        $cquery .= "client.email AS email, ";
        $cquery .= "client.ife AS ife ";
        $cquery .= "FROM client ";
        $cquery .= "WHERE client.id = " . $id;
        //Se ejecuta la sentencia SQL
        $lresult = mysqli_query($pconexion, $cquery);

        if (!$lresult) {
            $cerror = "No fue posible recuperar la informacion de la base de datos.<br>";
            $cerror .= "SQL: $cquery <br>";
            $cerror .= "Descripcion: " . mysqli_connect_error($pconexion);
            die($cerror);
        } else {
            //Verifica que la consulta haya devuelto por lo menos un registro
            if (mysqli_num_rows($lresult) > 0) {
                while ($adatos = mysqli_fetch_array($lresult, MYSQLI_BOTH)) {

                    $client->setId($adatos["id_client"]);
                    $client->setName($adatos["name"]);
                    $client->setLastName($adatos["last_name"]);
                    $client->setEmail($adatos["email"]);
                    $client->setIfe($adatos["ife"]);
                }
            }
        }
        mysqli_free_result($lresult);

        cerrarConexion($pconexion);
        return $client;
    }

    function add()
    {
        $name = $_POST["name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $ife = $_POST["ife"];

        $pconexion = abrirConexion();
        seleccionarBaseDatos($pconexion);
        $cquery = "SELECT email FROM client";
        $cquery .= " WHERE email = '$email' AND status = 1";

        if (!existeRegistro($pconexion, $cquery)) {
            $cquery = "INSERT INTO client";
            $cquery .= " (name, last_name, email, ife, status)";
            $cquery .= " VALUES ('$name', '$last_name', '$email', '$ife', 1)";
            if (insertarDatos($pconexion, $cquery)) {
                header('Location: index.php');
            } else {
                echo "<h1>No fue posible registrar el cliente en el catálogo</h1>";
            }
        } else {
            echo "<h1>Ya existe un cliente con el correo: $email</h1>";
        }
        cerrarConexion($pconexion);
    }

    function edit()
    {
        $name = $_POST["name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $ife = $_POST["ife"];
        $id = $_POST["idClient"];

        $pconexion = abrirConexion();
        seleccionarBaseDatos($pconexion);

        $cquery = "SELECT email FROM client";
        $cquery .= " WHERE email = '$email' AND status = 1";

        if(!existeRegistro($pconexion,$cquery)) {
            $cquery = "UPDATE client";
            $cquery .= " SET name = '$name', last_name='$last_name', email='$email', ife='$ife'";
            $cquery .= " WHERE client.id = " . $id;
            if (editarDatos($pconexion, $cquery)) {
                header('Location: index.php');
            } else {
                echo "<h1>No fue posible actualizar el cliente en el catálogo</h1>";
            }
        }else{
            $client = $this->findOneByEmail($email);
            if($client->getId()==$id){
                $cquery = "UPDATE client";
                $cquery .= " SET name = '$name', last_name='$last_name', email='$email', ife='$ife'";
                $cquery .= " WHERE client.id = " . $id;
                if (editarDatos($pconexion, $cquery)) {
                    header('Location: index.php');
                } else {
                    echo "<h1>No fue posible actualizar el cliente en el catálogo</h1>";
                }
            }else {
                header('Location: edit.php?idClient='.$id.'&email='.$email);
            }
        }
        cerrarConexion($pconexion);
        //return $cmensaje;
    }

    function delete($id)
    {

        $pconexion = abrirConexion();
        seleccionarBaseDatos($pconexion);

        $cquery = "UPDATE client";
        $cquery .= " SET status = 0";
        $cquery .= " WHERE client.id = " . $id;
        if (editarDatos($pconexion, $cquery)) {
            header('Location: ../view/Employee/client/index.php');
        } else {
            echo "<h1>No fue posible eliminar el cliente en el catálogo</h1>";
        }

        cerrarConexion($pconexion);
    }

}