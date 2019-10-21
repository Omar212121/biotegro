<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/salidasBe.php";
$obj = new salidasP();

$datos=  array(
$_POST['idsalida'],
$_POST['FolioU'],
$_POST['codigopU'],
$_POST['NombreselectionU'],
$_POST['Cantidades2U']
    
);

echo $obj->actualizarSalidas ($datos);

?>