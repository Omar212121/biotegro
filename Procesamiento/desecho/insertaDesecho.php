<?php

session_start();
$iduser=$_SESSION['iduser'];

require_once "../../clases/Conexion.php";
require_once "../../clases/desecho.php";

$obj= new desecho();

$datos=  array();
if($iduser>0){
$datos[0]=$_POST['Nombreselect'];
$datos[1]=$iduser;
$datos[2]=$_POST['Cantidades'];
        $datos[3]=   $_POST['Codigo'];

echo $obj->insertaDesecho($datos);
}else{
    echo 0;
}
    
?>