<?php

session_start();
$iduser = $_SESSION['iduser'];

require_once "../../clases/Conexion.php";
require_once "../../clases/berries.php";
$obj = new berries ();
$datos = array();

 if($iduser>0){
$datos[0] = $_POST['CategoriaSe'];
$datos[1] = $_POST['NombreB'];
$datos[2] = $_POST['DescripcionB'];
$datos[3] = $_POST['PresentacionB'];
$datos[4] = $_POST['CapacidadB'];
$datos[5]=$_POST['codigoB'];
$datos[6]=$_POST['stockB'];
$datos[7]=$_POST['Saldo'];


echo $obj->agregarBerries($datos);
 }  else {
     echo 0;
}
?>