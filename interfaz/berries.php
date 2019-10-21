<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Berries</title>
            <?php require_once "menu.php"; ?>
            <?php
            require_once "../clases/Conexion.php";
            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "SELECT id_categoria, nombreCategoria from categorias";
            $result = mysqli_query($conexion, $sql);
            ?>
        </head>
        <body>
            <div class="container">
                <h1>Productos</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <form id="frmBerries">
                            <label>Categoria</label>
                            <select class="form-control input-sm" id="CategoriaSe" name="CategoriaSe" >
                                <option value="A">Selecciona Categoria</option>
                                <?php while ($ver = mysqli_fetch_row($result)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <label>Codigo del producto</label>
                            <input type="text" class="form-control input-sm" id="codigoB" name="codigoB">
                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" id="NombreB" name="NombreB">
                            <label>Descripcion</label>
                            <input type="text" class="form-control input-sm" id="DescripcionB" name="DescripcionB">
                            <label>Presentacion</label>
                            <input type="text" class="form-control input-sm" id="PresentacionB" name="PresentacionB">
                            <label>Capacidad</label>
                            <input type="text" class="form-control input-sm" id="CapacidadB" name="CapacidadB">
                            <label>Saldo cajas</label>
                            <input type="text" class="form-control input-sm" id="stockB" name="stockB">
                            <label>Saldo piezas</label>
                            <input type="text" class="form-control input-sm" id="Saldo" name="Saldo">
                            <p></p>
                            <span id="btnAgregarBerrie" class="btn btn-primary">Agregar</span>
                        </form>
                    </div>
                    <div class="col-sm-8">
                        <div id="tablaBerriesLoad"></div>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="updateberries" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmBerriesU">
                                <input type="text" id="idberries" hidden="" name="idberries">
                                <label>Codigo del producto</label>
                                <input type="text" class="form-control input-sm" id="codigoBU" name="codigoBU">
                                <label>Nombre</label>
                                <input type="text" class="form-control input-sm" id="NombreBU" name="NombreBU">
                                <label>Descripcion</label>
                                <input type="text" class="form-control input-sm" id="DescripcionBU" name="DescripcionBU">
                                <label>Presentacion</label>
                                <input type="text" class="form-control input-sm" id="PresentacionBU" name="PresentacionBU">
                                <label>Capacidad</label>
                                <input type="text" class="form-control input-sm" id="CapacidadBU" name="CapacidadBU">
                                <label>Saldo cajas</label>
                                <input type="text" class="form-control input-sm" id="stockBU" name="stockBU">
                                <label>Saldo piezas</label>
                                <input type="text" class="form-control input-sm" id="SaldoU" name="SaldoU">
                                <p></p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="BtnactualizaBerrie" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

        </body>
    </html>
    <script type="text/javascript">
        function obtenDatosBerries(idberries) {
            $.ajax({
                type: "POST",
                data: "idart=" + idberries,
                url: "../procesamiento/berries/obtenDatosBerries.php",
                success: function (r) {
                    alert(r);
                    dato = jQuery.parseJSON(r);
                    $('#idberries').val(dato['id_berrie']);
                    $('#codigoBU').val(dato['code_brg']);
                    $('#NombreBU').val(dato['nombre']);
                    $('#DescripcionBU').val(dato['descripcion']);
                    $('#PresentacionBU').val(dato['presentacion']);
                    $('#CapacidadBU').val(dato['capacidad']);
                    $('#stockBU').val(dato['stock']);
                    $('#SaldoU').val(dato['Stockp']);

                }
            });
        }
        function eliminaBerrie(idberries){
			alertify.confirm('¿Desea eliminar ?', function(){ 
				$.ajax({
					type:"POST",
					data:"idBerries=" + idberries,
					url:"../procesamiento/berries/eliminarBerries.php",
					success:function(r){
                                            alert(r);
						if(r==1){
            $('#tablaBerriesLoad').load("berries/tablaBerries.php");

            alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#BtnactualizaBerrie').click(function () {

                datos = $('#frmBerriesU').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/berries/actualizaBerries.php",
                    success: function (r) {
                        if (r == 1) {
                            $('#tablaBerriesLoad').load("berries/tablaBerries.php");

                            alertify.success("Actualización Exitosa");
                        } else {
                            alertify.error("Error");
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tablaBerriesLoad').load("berries/tablaBerries.php");

            $('#btnAgregarBerrie').click(function () {

                vacios = validarFormVacio('frmBerries');

                if (vacios > 0) {
                    alertify.alert("Tienes que llenar todos los campos");
                    return false;
                }

                datos = $('#frmBerries').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/berries/agregarBerries.php",
                    success: function (r) {
                        alert(r);
                        if (r == 1) {
                            $('#frmBerries')[0].reset();

                            alertify.success("agregado con exito");
                        } else {
                            alertify.error("no se puedo agregar");
                        }
                    }
                });
            });
        });
    </script>
    <?php
} else {
    header("location:../index.php");
}
?>



