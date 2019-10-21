<?php
  
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/clientes.php";

$obj= new clientes();

$datos= array(
$_POST['nombre'],
        $_POST['email'],
        $_POST['telefono']
);
 

echo $obj->agregarClientes($datos);
?>