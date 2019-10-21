<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/berries.php";

$idart=$_POST['idBerries'];

$obj= new berries();


echo $obj->eliminarBerries ($idart);

?>