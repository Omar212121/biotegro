<?php

class salidas {

    public function obtenDatosProducto($idproducto) {
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_entrada,nombre,descripcion,cantidad,detalle from entrada where id_entrada='$idproducto'";
        $result = mysqli_query($conexion, $sql);

        $ver = mysqli_fetch_row($result);
        $datos = array(
            'id_entrada' => $ver[1],
            'descripcion' => $ver[2],
            'cantidad' => $ver[3],
            'detalle ' => $ver[4]
        );
        return $data;
    }

    public function crearSalida() {
        $c= new conectar();
		$conexion=$c->conexion();
		$fecha=date('Y-m-d');
		$idsalida=self::creaFolio();
		$datos=$_SESSION['Temporal'];
		$idusuario=$_SESSION['iduser'];

                
		$r=0;

		for ($i=0; $i < count($datos) ; $i++) { 
			$d=explode("||", $datos[$i]);

			$sql="INSERT into salidas (id_salidas,
										id_cliente,
										id_entrada,
										id_usuario,
										cantidad,
                                                                                piezas,
										fechaCompra)
							values ('$idsalida',
									'$d[7]',
									'$d[0]',
									'$idusuario',
									'$d[3]',
                                                                        '$d[4]',
									'$fecha')";
			$r=$r + $result=mysqli_query($conexion,$sql);
                        
                        
		}

		return $r;
	}
        
        
                

        

        public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_salidas from salidas group by id_salidas desc";

		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}
	public function nombreCliente($idCliente){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT nombre,email 
			from clientes 
			where id_cliente='$idCliente'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function obtenerTotal($idsalida){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT cantidad 
				from salidas
				where id_salidas='$idsalida'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}
        
          public function eliminarSalida($idsalida) {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "DELETE from salidas where id_salidas='$idsalida'";

        return mysqli_query($conexion, $sql);
    }

        
}

?>








