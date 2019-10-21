<?php
session_start();
$iduser=$_SESSION['iduser'];
require_once "../../clases/Conexion.php";
require_once "../../clases/salidasBe.php";

$obj= new salidasP ();
$datos= array();


$datos[0]= $_POST['Nombreselection'];
$datos[1]=$iduser;
$datos[2]=$_POST['Cantidades2'];
$datos[3]=$_POST['Folio'];
$datos[4]=$_POST['categoriaselect2'];
$datos[5]=$_POST['codigop'];
$datos[6]=$_POST['Piezas2'];



echo $obj->insertaSalida($datos);

  
?>