<?php

class berries {

    public function agregarBerries($datos) {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "INSERT into berries(id_categoria,nombre,descripcion,presentacion,capacidad,code_brg,stock, Stockp)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]', '$datos[3]', '$datos[4]','$datos[5]', '$datos[6]','$datos[7]')";

        return mysqli_query($conexion, $sql);
    }

    public function obtenDatosBerries($idberries) {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT 
id_berrie,            
nombre,
            descripcion,
            presentacion,
            capacidad,
            code_brg,
            stock,
            Stockp
            FROM berries 
            where id_berrie= '$idberries'";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_row($result);

        $datos = array(
        "id_berrie" => $ver[0],
        "nombre" => $ver[1],
        "descripcion" => $ver[2],
        "presentacion" =>$ver[3],
        "capacidad" => $ver[4],
        "code_brg" => $ver[5],
        "stock" => $ver[6],
        "Stockp" => $ver[7],
        );
        
        return $datos;
    }
    
    public function actualizaBerries($datos){
          $c = new conectar();
        $conexion = $c->conexion();
        
        $sql="UPDATE berries set nombre = '$datos[2]',
            descripcion = '$datos[3]',
            presentacion = '$datos[4]',
            capacidad = '$datos[5]',
            code_brg = '$datos[1]',
            stock = '$datos[6]',
            Stockp = '$datos[7]'
            where id_berrie= '$datos[0]'";
        
        return mysqli_query ($conexion,$sql);
    }
    
    public function eliminarBerries ($idberries){
         $c = new conectar();
        $conexion = $c->conexion();
        
        $sql="DELETE from berries 
                where id_berrie='$idberries'";
        return mysqli_query($conexion,$sql);
    }
}

?>