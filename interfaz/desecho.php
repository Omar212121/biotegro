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
            $sql = "SELECT id_empaque ,nombre FROM empaque";
            $result = mysqli_query($conexion, $sql);
            ?>

        </head>

        <body  >
            <div class="container">
                <h1>Entradas Desecho</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <form id="frmEntrada">                       

                            <label>Codigo del Producto</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="Codigo" name="Codigo">
                            <label>Selecciona Nombre</label>                            
                            <select style="border: 2px solid DodgerBlue;" class="form-control input-sm" id="Nombreselect" name="Nombreselect">
                                <option value="A">Selecciona Nombre</option>
                                <?php
                                $sql = "SELECT id_empaque ,nombre FROM empaque";
                                $result = mysqli_query($conexion, $sql);
                                ?>
                                <?php while ($ver = mysqli_fetch_row($result)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1] ?></option>
                                <?php endwhile; ?>
                            </select>

                            <label>Descripcion</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="descripciones" name="descripciones">
                            <label>piezas</label>
                            <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="Cantidades" name="Cantidades">                           
                            <p></p>
                            <span class="btn btn-primary" id="btnAgregarEntrada">Agregar</span>
                        </form>
                    </div>
                    <div class="col-sm-8">
                        <div id="tablaEntradaLoad"></div>
                    </div>
                </div>

            </div>



            <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Ventana Actualizar</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmEntradaU">                       
                                <input type="text" id="iddesecho" hidden="" name="iddesecho">
                                <label>Codigo del Producto</label>
                                <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="CodigoU" name="CodigoU">   
                                <label>Selecciona Nombre</label>                            
                                <select style="border: 2px solid DodgerBlue;" class="form-control input-sm" id="NombreselectU" name="NombreselectU">
                                    <option value="A">Selecciona Nombre</option>
                                    <?php
                                    $sql = "SELECT id_empaque ,nombre FROM empaque";
                                    $result = mysqli_query($conexion, $sql);
                                    ?>
                                    <?php while ($ver = mysqli_fetch_row($result)): ?>
                                        <option value="<?php echo $ver[0] ?>"><?php echo $ver[1] ?></option>
                                    <?php endwhile; ?>
                                </select>

                                <label>piezas</label>
                                <input style="border: 2px solid DodgerBlue;" type="text" class="form-control input-sm" id="CantidadesU" name="CantidadesU">                           
                                <p></p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btnActualizaDesecho" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>


        </body>
    </html>

    <script type="text/javascript">
        function agregaDatosDesecho(iddesecho) {
            $.ajax({
                type: "POST",
                data: "idde=" + iddesecho,
                url: "../procesamiento/desecho/obtenDatosDesecho.php",
                success: function (r) {
                    dato = jQuery.parseJSON(r);
                    $('#iddesecho').val(dato['id_desecho']);
                    $('#CodigoU').val(dato['code_bgr']);
                    $('#NombreselectU').val(dato['id_empaque']);
                    $('#CantidadesU').val(dato['piezas']);

                }
            });
        }

        function eliminarDesecho(iddesecho) {
            alertify.confirm('¿Desea eliminar ?', function () {
                $.ajax({
                    type: "POST",
                    data: "idDesecho=" + iddesecho,
                    url: "../procesamiento/desecho/eliminarDesecho.php",
                    success: function (r) {
                        alert(r);
                        if (r == 1) {
                            $('#tablaEntradaLoad').load("desechos/tabladesechos.php");

                            alertify.success("Eliminado con exito!!");
                        } else {
                            alertify.error("No se pudo eliminar :(");
                        }
                    }
                });
            }, function () {
                alertify.error('Cancelo ')
            });
        }

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#btnActualizaDesecho').click(function () {

                datos = $('#frmEntradaU').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/desecho/ActualizaDesecho.php",
                    success: function (r) {
                        if (r == 1) {
                            $('#tablaEntradaLoad').load("desechos/tabladesechos.php");

                            alertify.success("exito");
                        } else {
                            alertify.error("no");
                        }
                    }
                });
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#tablaEntradaLoad').load("desechos/tabladesechos.php");
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
                    url: "../procesamiento/desecho/insertaDesecho.php",
                    success: function (r) {
                        alert(r);
                        if (r == 1) {
                            $('#frmEntrada')[0].reset();

                            alertify.success("agregado con exito");
                        } else {
                            alertify.error("no se pudo agregar");
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