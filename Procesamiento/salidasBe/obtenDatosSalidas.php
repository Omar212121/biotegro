<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/salidasBe.php";

$obj= new salidasP ();

$idart=$_POST['idart'];

echo json_encode($obj->obtenDatosSalidas($idart));
?>