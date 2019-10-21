<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/entradas.php";

$obj= new entradas();

$idart=$_POST['idart'];

echo json_encode($obj->agregaDatosEntrada($idart));
?>