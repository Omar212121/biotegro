<?php
session_start();
$iduser=$_SESSION['iduser'];
require_once "../../clases/Conexion.php";
require_once "../../clases/entradas.php";

$obj= new entradas();
$datos=array();
   if($iduser>0){

$datos[0]=$_POST['Nombreselect'];
$datos[1]=$iduser;
$datos[2]=$_POST['Cantidades'];
$datos[3]=$_POST['Folio'];
$datos[4]=$_POST['Codigo'];
$datos[5]=$_POST['piezas'];


 echo $obj-> insertarEntrada($datos);

    
}else{
    echo 0;
}
    
?>

