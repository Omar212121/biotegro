<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/salidasBe.php";

$idart=$_POST['idSalida'];
$obj = new salidasP();

echo $obj->eliminarSalidas($idart);
?>