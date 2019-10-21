<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/clamshell.php";
$obj= new clamshell();
$datos=  array(
    $_POST['idclamshell'],
 $_POST['codigoCU'],
 $_POST['NombreCU'],
 $_POST['DescripcionCU'],
 $_POST['SaldoCU'],
 $_POST['UnidadU']   
);

 echo $obj->actualizaClamshell($datos);
        
?>