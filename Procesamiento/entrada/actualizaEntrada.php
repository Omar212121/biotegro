<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/entradas.php";

$obj = new entradas();

$datos= array(
$_POST['identrada'],
$_POST['FolioU'],
$_POST['CodigoU'],
$_POST['NombreselectU'],
$_POST['descripcionesU'],
$_POST['CantidadesU'],
);
echo $obj->ActualizaEntrada($datos);
?>
