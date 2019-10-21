<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/clamshell.php";

$idart=$_POST['idClamshells'];
$obj= new clamshell();

echo $obj->eliminarClamshell($idart);
?>