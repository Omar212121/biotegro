<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/berries.php";

$obj= new berries();

$idart=$_POST['idart'];

echo json_encode($obj->obtenDatosBerries($idart));
?>