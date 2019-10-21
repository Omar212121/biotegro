<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/berries.php";

$obj = new berries();


$datos= array(
$_POST['idberries'],
$_POST['codigoBU'],
$_POST['NombreBU'],
$_POST['DescripcionBU'],
$_POST['PresentacionBU'],
$_POST['CapacidadBU'],
$_POST['stockBU'],
$_POST['SaldoU']
);
echo $obj->actualizaBerries($datos);
?>