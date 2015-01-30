<?php
include_once("SessionService.php");
session_start();
function listarMenu()
{
    $menu = "";
    //if(isset($_SESSION["cidusuario"]) && ($_SESSION["cidusuario"] == "admin")){
    if (isset($_SESSION["cidusuario"])) {
        $rolArray = obtenerInfoSesion();
        if ($rolArray[0] == 1) {

            $menu .= "<a class=\"menu\" href=\"index.php\">";
            $menu .= "Inicio";
            $menu .= "</a>&nbsp;";

            $menu .= "<a class=\"menu\" href=\"#\">";
            $menu .= "Administrar usuarios";
            $menu .= "</a>&nbsp;";

            $menu .= "<a class=\"menu\" href=\"#\">";
            $menu .= "Administrar empleados";
            $menu .= "</a>&nbsp;";

            $menu .= "<a class=\"menu\" href=\"#\">";
            $menu .= "Administrar peliculas";
            $menu .= "</a>&nbsp;";

            $menu .= "<a class=\"menu\" href=\"#\">";
            $menu .= "Cuenta";
            $menu .= "</a>&nbsp;";

            $menu .= "<a class=\"menu\" href=\"http://localhost/ApplicationWebMVC/src/services/close_sesion.php\">";
            $menu .= "Cerrar Sesion";
            $menu .= "</a>&nbsp;";


        } //if(isset($_SESSION["cidusuario"]) && ($_SESSION["cidusuario"] == "cliente")){
        elseif ($rolArray[0] == 2) {


            $menu .= "<a class=\"menu\" href=\"index.php\">";
            $menu .= "Inicio";
            $menu .= "</a>&nbsp;";

            $menu .= "<a class=\"menu\" href=\"../view/client/index.php\">";
            $menu .= "Clientes";
            $menu .= "</a>&nbsp;";


            $menu .= "<a class=\"menu\" href=\"#\">";
            $menu .= "Renta/Devolcuiones";
            $menu .= "</a>&nbsp;";

            $menu .= "<a class=\"menu\" href=\"#\">";
            $menu .= "Corte de caja";
            $menu .= "</a>&nbsp;";

            $menu .= "<a class=\"menu\" href=\"#\">";
            $menu .= "Cuenta";
            $menu .= "</a>&nbsp;";

            $menu .= "<a class=\"menu\" href=\"http://localhost/ApplicationWebMVC/src/services/close_sesion.php\">";
            $menu .= "Cerrar Sesion";
            $menu .= "</a>&nbsp;";

        }

        return $menu;
    }
}

 ?>