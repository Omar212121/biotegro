<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/entradas.php";

$idart=$_POST['identrada'];
        $obj= new entradas();
        echo $obj->eliminaentrada($idart)
?>