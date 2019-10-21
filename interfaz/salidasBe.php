<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>Salidas</title>
            <?php require_once "menu.php"; ?>
            <?php
            require_once "../clases/Conexion.php";
            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "SELECT id_berrie,nombre FROM berries";
            $result = mysqli_query($conexion, $sql);
            ?>

        </head>

        <body>
            <div class="container">
                <h1>Salidas de productos</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <form id="frmsalidas">
                            <label>Folio de Salida</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="Folio" name="Folio">
                            <label>codigo del producto</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="codigop" name="codigop">
                            <label>Selecciona Nombre</label>                            
                            <select style="border: 2px solid DodgerBlue;" class="form-control input-sm" id="Nombreselection" name="Nombreselection">
                                <option value="A">Selecciona Nombre</option>
                                <?php while ($ver = mysqli_fetch_row($result)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1] ?></option>
                                <?php endwhile; ?>
                            </select>
                            <label>Selecciona Cliente</label>                            
                            <select style="border: 2px solid DodgerBlue;" class="form-control input-sm" id="categoriaselect2" name="categoriaselect2">
                                <option value="A">Selecciona Categoria</option>
                                <?php
                                $sql = "  SELECT id_cliente,nombre from clientes";
                                $result = mysqli_query($conexion, $sql);
                                while ($vista = mysqli_fetch_row($result)):
                                    ?>
                                    <option value="<?php echo $vista[0] ?>"><?php echo $vista[1] ?></option>
                                <?php endwhile; ?>
                            </select>            
                            <label>Descripcion</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="descripciones2" name="descripciones2">

                            <label>Cantidad</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="Cantidades2" name="Cantidades2">
                            <label>Piezas</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="Piezas2" name="Piezas2">
                            <p></p>
                            <span class="btn btn-primary" id="btnAgregarSalida">Agregar</span>
                        </form>
                    </div>
                    <div class="col-sm-8">
                        <div id="tablaFueraLoad"></div>
                    </div>
                </div>
            </div>




            <!-- Modal -->
            <div class="modal fade" id="updatesalidas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Actualizar</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmsalidasU">
                                <input type="text" id="idsalida" hidden="" name="idsalida">
                                <label>Folio de Salida</label>
                                <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="FolioU" name="FolioU">
                                <label>codigo del producto</label>
                                <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="codigopU" name="codigopU">
                                <label>Selecciona Nombre</label>                            
                                <select style="border: 2px solid DodgerBlue;" class="form-control input-sm" id="NombreselectionU" name="NombreselectionU">
                                    <option value="A">Selecciona Nombre</option>
                                    <?php
                                    $sql = "SELECT id_berrie,nombre FROM berries";
                                    $result = mysqli_query($conexion, $sql);
                                    ?>
                                    <?php while ($ver = mysqli_fetch_row($result)): ?>
                                        <option value="<?php echo $ver[0] ?>"><?php echo $ver[1] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <label>Cantidad</label>
                                <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="Cantidades2U" name="Cantidades2U">

                                <p></p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btnActualizarSalidas" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>


        </body>

    </html>
    <script type="text/javascript">
        function agregaDatosSalidas(idsalida) {
            $.ajax({
                type: "POST",
                data: "idart=" + idsalida,
                url: "../procesamiento/salidasBe/obtenDatosSalidas.php",
                success: function (r) {
                    dato = jQuery.parseJSON(r);
                    $('#idsalida').val(dato['id_salidas']);
                    $('#FolioU').val(dato['Folio']);
                    $('#codigopU').val(dato['code_brg']);
                    $('#NombreselectionU').val(dato['id_berrie']);
                    $('#Cantidades2U').val(dato['cantidad']);     
                }
            });
        }
        function eliminaSalidas (idsalida){
			alertify.confirm('¿Desea eliminar ?', function(){ 
				$.ajax({
					type:"POST",
					data:"idSalida=" + idsalida,
					url:"../procesamiento/salidasBe/eliminarSalidas.php",
					success:function(r){
						if(r==1){
                                                                                    $('#tablaFueraLoad').load("salidasBe/tablaSalidasBe.php");

							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}


    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
              $('#btnActualizarSalidas').click(function () {

        datos = $('#frmsalidasU').serialize();
        $.ajax({
            type: "POST",
            data: datos,
            url: "../procesamiento/salidasBe/actualizarSalidas.php",
            success: function (r) {
                alert(r);
                if(r==1){
                                $('#tablaFueraLoad').load("salidasBe/tablaSalidasBe.php");

                    alertify.success("exito");
                }else{
                    alertify.error("error");
                }
            }
        });
    });
        });
    
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tablaFueraLoad').load("salidasBe/tablaSalidasBe.php");
            $('#btnAgregarSalida').click(function () {

                vacios = validarFormVacio('frmsalidas');
                if (vacios > 0) {
                    alertify.alert("debes de llenar todos los campos");
                    return false;
                }

                datos = $('#frmsalidas').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/salidasBe/insertaSalidas.php",
                    success: function (r) {
                        alert(r);
                        if (r == 1) {
                            $('#frmsalidas')[0].reset();
                            $('#tablaFueraLoad').load("salidasBe/tablaSalidasBe.php");

                            alertify.success("Agregado con exito");
                        } else {
                            alertify.error("No se pudo agregar");
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