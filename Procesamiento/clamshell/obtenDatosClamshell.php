<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/clamshell.php";

$obj= new clamshell();

$idart=$_POST['idart'];

echo json_encode($obj->obtenDatosClamshell($idart));
?>