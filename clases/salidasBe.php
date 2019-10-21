<?php

class salidasP {

    public function insertaSalida($datos) {
        $c = new conectar();
        $conexion = $c->conexion();
        date_default_timezone_set("America/Mexico_City");
        $fecha = date('Y-m-d H:i:s');

        $sql = "INSERT into salidas (id_berrie,
id_usuario,
cantidad,
Folio,
id_cliente,
code_brg,
piezas,
fechaCompra)
               values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$fecha')";
        return mysqli_query($conexion, $sql);
    }

    public function obtenDatosSalidas($idsalida) {
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_salidas,
            
           id_berrie, 
            cantidad,
            Folio,
            code_brg,
            piezas
                from salidas
                where id_salidas='$idsalida'";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_row($result);

        $datos = array(
        "id_salidas" => $ver[0],
        "id_berrie" => $ver[1],
        "cantidad" => $ver[2],
        "Folio" => $ver[3],
        "code_brg" => $ver[4],
         "piezas" => $ver[5]
        );
        return $datos;
    }
    
    public function actualizarSalidas ($datos){
          $c = new conectar();
        $conexion = $c->conexion();
        $sql ="UPDATE salidas set id_berrie='$datos[3]', 
            cantidad='$datos[4]',
            Folio='$datos[1]',
            code_brg='$datos[2]'
            where id_salidas='$datos[0]'";
        
        return mysqli_query($conexion,$sql);
    }
    public function eliminarSalidas($idsalida){
          $c = new conectar();
        $conexion = $c->conexion();
        
        $sql="DELETE from salidas   where id_salidas='$idsalida'";
        
        return mysqli_query($conexion,$sql);
    }

}

?>