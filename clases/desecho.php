<?php

class desecho {

    public function insertaDesecho($datos) {
        $c = new conectar();
        $conexion = $c->conexion();
        date_default_timezone_set("America/Mexico_City");
        $fecha = date('Y-m-d H:i:s');

        $sql = "INSERT into desecho (id_empaque,id_usuario,piezas,code_bgr,fechaCaptura)
               values ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$fecha')";
        return mysqli_Query($conexion, $sql);
    }

    public function obtenDatosDesecho($iddesecho) {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT 
            id_desecho,
            id_empaque,
                        piezas, 
                        code_bgr
                        from desecho 
                        where id_desecho='$iddesecho'";
        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_row($result);

        $datos = array(
        "id_desecho" => $ver[0],
        "id_empaque" =>$ver[1],
        "piezas" =>$ver[2],
        "code_bgr" =>$ver[3]
                
        );
                return $datos;

    }
    public  function ActualizaDesecho($datos){
        $c = new conectar();
        $conexion = $c->conexion();
        
        $sql="UPDATE desecho set id_empaque ='$datos[2]',
                        piezas ='$datos[3]', 
                        code_bgr  ='$datos[1]'
                        where id_desecho='$datos[0]' ";
        return mysqli_query($conexion, $sql);
    }
    
    public function eliminarDesecho ($iddesecho){
         $c = new conectar();
        $conexion = $c->conexion();
        
        $sql="DELETE from desecho where id_desecho='$iddesecho'";
        
       return mysqli_query($conexion,$sql);
    }
   
}

?>