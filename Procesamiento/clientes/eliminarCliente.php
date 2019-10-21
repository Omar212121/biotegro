<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/clientes.php";
$obj = new clientes();


echo $obj->eliminarCliente($_POST['idcliente']);
?>