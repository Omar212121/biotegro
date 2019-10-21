<?php

class clamshell {

    public function agregaClamshell($datos) {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "INSERT into empaque (code_bgr,
            nombre,
            descripcion,
            saldo,
            PrecioUnidad)
                values('$datos[0]',
                '$datos[1]',
                '$datos[2]',
                '$datos[3]',
                '$datos[4]')";
        return mysqli_query($conexion, $sql);
    }

    public function obtenDatosClamshell($idclamshell) {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT 
               id_empaque,            
                code_bgr,
                nombre,
                descripcion,
                saldo,
                PrecioUnidad 
                from empaque 
                where id_empaque='$idclamshell'";
        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_row($result);

        $datos = array(
            "id_empaque" => $ver[0],
            "code_bgr" => $ver[1],
            "nombre" => $ver[2],
            "descripcion" => $ver[3],
            "saldo" => $ver[4],
            "PrecioUnidad" => $ver[5]
        );

        return $datos;
    }

    public function actualizaClamshell($datos) {
        $c = new conectar();
        $conexion = $c->conexion();
        
        $sql="UPDATE empaque set 
                code_bgr='$datos[1]',
                nombre='$datos[2]',
                descripcion='$datos[3]',
                saldo='$datos[4]',
                PrecioUnidad='$datos[5]'
                where id_empaque='$datos[0]'";
        
                return mysqli_query ($conexion,$sql);

    }
public function eliminarClamshell($idclamshell){
      $c = new conectar();
        $conexion = $c->conexion();
        
        $sql="DELETE from empaque 
                where id_empaque='$idclamshell'";
        return mysqli_query($conexion,$sql);
        
}    

}

?>