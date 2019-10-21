<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>entradas</title>
            <?php require_once "menu.php"; ?>
            <?php
            require_once "../clases/Conexion.php";
            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "SELECT id_berrie,nombre FROM berries";
            $result = mysqli_query($conexion, $sql);
            ?>

        </head>

        <body  >
            <div class="container">
                <h1>Entradas</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <form id="frmEntrada">                       
                            <label>Folio de Entrada</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="Folio" name="Folio">
                            <label>Codigo del Producto</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="Codigo" name="Codigo">
                            <label>Selecciona Nombre</label>                            
                            <select style="border: 2px solid DodgerBlue;" class="form-control input-sm" id="Nombreselect" name="Nombreselect">
                                <option value="A">Selecciona Nombre</option>
                                <?php while ($ver = mysqli_fetch_row($result)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1] ?></option>
                                <?php endwhile; ?>
                            </select>
                            

                            <label>Descripcion</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="descripciones" name="descripciones">
                            <label>Cajas</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="Cantidades" name="Cantidades">
                            <label>piezas</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="piezas" name="piezas">
                           
                            <p></p>
                            <span class="btn btn-primary" id="btnAgregarEntrada">Agregar</span>
                        </form>
                    </div>
                    <div class="col-sm-8">
                        <div id="tablaEntradaLoad"></div>
                    </div>
                </div>

            </div>




            <!-- Modal -->
            <div class="modal fade" id="abremodalUpdateEntrada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Actualizar entrada</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmEntradau">                       
                                <input type="text" id="identrada" hidden="" name="identrada">
                                <label>Folio de Entrada</label>
                                <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="FolioU" name="FolioU">
                                <label>Codigo del Producto</label>
                                <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="CodigoU" name="CodigoU">
                                <label>Selecciona Nombre</label>                            
                                <select style="border: 2px solid DodgerBlue;" class="form-control input-sm" id="NombreselectU" name="NombreselectU">
                                    <option value="A">Selecciona Nombre</option>
                                    <?php
                                    $sql = "SELECT id_berrie,nombre FROM berries";
                                    $result = mysqli_query($conexion, $sql);
                                    ?>
                                    <?php while ($ver = mysqli_fetch_row($result)): ?>
                                        <option value="<?php echo $ver[0] ?>"><?php echo $ver[1] ?></option>
                                    <?php endwhile; ?>
                                </select>                           
                                <label>Descripcion</label>
                                <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="descripcionesU" name="descripcionesU">
                                <label>Cantidad</label>
                                <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="CantidadesU" name="CantidadesU">
                                <p></p>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btnActualizaarticulo" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>


        </body>


    </html>


    <script type="text/javascript">
        function agregaDatosEntrada(identrada) {
            $.ajax({
                type: "POST",
                data: "idart=" + identrada,
                url: "../procesamiento/entrada/agregaDatosEntrada.php",
                success: function (r) {
                    alert(r);
                    dato = jQuery.parseJSON(r);
                    $('#identrada').val(dato['id_entrada']);
                    $('#FolioU').val(dato['Folio']);

                    $('#CodigoU').val(dato['code_brg']);
                    $('#NombreselectU').val(dato['id_berrie']);
                    $('#CantidadesU').val(dato['cantidad']);


                }
            });
        }
    </script>

    <script>
        $('#btnActualizaarticulo').click(function () {

            datos = $('#frmEntradau').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesamiento/entrada/actualizaEntrada.php",
                success: function (r) {
                    if (r == 1) {
                        $('#tablaEntradaLoad').load("entrada/tablaentrada.php");

                        alertify.success("actualizado con exito");
                    } else {
                        alertify.error("error")
                    }

                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#tablaEntradaLoad').load("entrada/tablaentrada.php");

            $('#btnAgregarEntrada').click(function () {

                vacios = validarFormVacio('frmEntrada');

                if (vacios > 0) {
                    alertify.alert("Tienes que llenar todos los campos");
                    return false;
                }


                datos = $('#frmEntrada').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/entrada/insertaEntrada.php",
                    success: function (r) {
                        alert(r);
                        if (r == 1) {
                            $('#frmEntrada')[0].reset();
                            $('#tablaEntradaLoad').load("entrada/tablaentrada.php");

                            alertify.success("agregado con exito");
                        } else {
                            alertify.error("error al agregar");
                        }
                    }
                });
            });
        });

    </script>
    <script>
        function eliminaEntrada(idEntrada) {
            alertify.confirm('¿Seguro que quiere eliminar?', function () {
                $.ajax({
                    type: "POST",
                    data: "identrada=" + idEntrada,
                    url: "../procesamiento/entrada/eliminarCategoria.php",
                    success: function (r) {
                        if (r == 1) {
                            $('#tablaEntradaLoad').load("entrada/tablaentrada.php");

                            alertify.success("Eliminado con exito!!");
                        } else {
                            alertify.error("error al eliminar");
                        }
                    }
                });
            }, function () {
                alertify.error('Cancelo !')
            });
        }
    </script>
    <?php
} else {
    header("location:../index.php");
}
?>