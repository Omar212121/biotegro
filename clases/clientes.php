<?php

class clientes {

    public function agregarClientes($datos) {
        $c = new conectar();
        $conexion = $c->conexion();

        $idusuario = $_SESSION['iduser'];

        $sql = "INSERT into clientes (id_usuario,
										nombre,
										email,
										telefono
										)
							values ('$idusuario',
									'$datos[0]',
									'$datos[1]',
									'$datos[2]')";


        return mysqli_query($conexion, $sql);
    }

    public function eliminarCliente($idcliente) {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "DELETE from clientes where id_cliente='$idcliente'";

        return mysqli_query($conexion, $sql);
    }

}
?>
 

