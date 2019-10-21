<?php

class entradas {

    public function insertarEntrada($datos) {
        $c = new conectar();
        $conexion = $c->conexion();
        date_default_timezone_set("America/Mexico_City");
        $fecha = date('Y-m-d H:i:s');

        $sql = "INSERT into entrada(id_berrie,id_usuario,cantidad,Folio,code_brg,piezas,fechaCaptura) 
                Values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$fecha')";

        return mysqli_query($conexion, $sql);
    }

    public function eliminaentrada($identrada) {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "DELETE from entrada where id_entrada='$identrada'";

        return mysqli_query($conexion, $sql);
    }

    public function agregaDatosEntrada($identrada) {
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_entrada,
            id_berrie,
            cantidad,
Folio,
code_brg
from entrada where id_entrada='$identrada'";
        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_row($result);

        $datos = array(
        "id_entrada" => $ver[0],
        "id_berrie" =>$ver[1],
        "cantidad" =>$ver[2],
        "Folio" =>$ver[3],
        "code_brg" =>$ver[4]
        );
        return $datos;
    }
    public function ActualizaEntrada($datos){
        $c = new conectar();
        $conexion = $c->conexion();
        
        $sql="Update entrada set id_berrie='$datos[3]',
            cantidad='$datos[5]',
Folio='$datos[1]',
code_brg='$datos[2]'
where id_entrada='$datos[0]' ";
        
        return mysqli_query($conexion, $sql);
    }
}

?>