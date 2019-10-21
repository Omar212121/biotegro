<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/desecho.php";

$obj= new desecho();
$idde=$_POST['idde'];

echo json_encode($obj->obtenDatosDesecho($idde));
?>