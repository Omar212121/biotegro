<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/desecho.php";

$obj=new desecho();

$datos=  array(
 $_POST['iddesecho'],
 $_POST['CodigoU'],
 $_POST['NombreselectU'],
 $_POST['CantidadesU']
        );
echo $obj->ActualizaDesecho($datos);
?>