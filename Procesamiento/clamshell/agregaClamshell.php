<?php

session_start();
$iduser = $_SESSION['iduser'];

require_once "../../clases/Conexion.php";
require_once "../../clases/clamshell.php";

$obj = new clamshell();

$datos = array();

 if($iduser>0){

$datos[0] = $_POST['codigoC'];
$datos[1] = $_POST['NombreC'];

$datos[2] = $_POST['DescripcionC'];

$datos[3] = $_POST['SaldoC'];
 $datos[4] = $_POST['Unidad'];


echo $obj->agregaClamshell($datos);
}  else {
     echo 0;
}
?>