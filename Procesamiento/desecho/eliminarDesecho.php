<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/desecho.php";

$idde=$_POST['idDesecho'];
 
$obj= new desecho ();

echo $obj->eliminarDesecho ($idde);
?>