<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Clamshell</title>
            <?php require_once "menu.php"; ?>
            <?php
            require_once "../clases/Conexion.php";
            ?>
        </head>
        <body>
            <div class="container">
                <h1>Clamshell</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <form id="frmClamshell">                         
                            <label>Codigo del producto</label>
                            <input type="text" class="form-control input-sm" id="codigoC" name="codigoC">
                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" id="NombreC" name="NombreC">
                            <label>Descripcion</label>
                            <input type="text" class="form-control input-sm" id="DescripcionC" name="DescripcionC">
                            <label>Saldo</label>
                            <input type="text" class="form-control input-sm" id="SaldoC" name="SaldoC">
                            <label>Precio por Unidad</label>
                            <input type="text" class="form-control input-sm" id="Unidad" name="Unidad">
                            <p></p>
                            <span id="btnAgregarClamshell" class="btn btn-primary">Agregar</span>
                        </form>
                    </div>
                    <div class="col-sm-8">
                        <div id="tablaClamshellLoad"></div>
                    </div>
                </div>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm"  role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">                           
                            <form id="frmClamshellU">  
                                <input type="text" id="idclamshell" hidden="" name="idclamshell">
                                <label>Codigo del producto</label>
                                <input type="text" class="form-control input-sm" id="codigoCU" name="codigoCU">
                                <label>Nombre</label>
                                <input type="text" class="form-control input-sm" id="NombreCU" name="NombreCU">
                                <label>Descripcion</label>
                                <input type="text" class="form-control input-sm" id="DescripcionCU" name="DescripcionCU">
                                <label>Saldo</label>
                                <input type="text" class="form-control input-sm" id="SaldoCU" name="SaldoCU">
                                <label>Precio por Unidad</label>
                                <input type="text" class="form-control input-sm" id="UnidadU" name="UnidadU">
                                <p></p>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button id="btnActualizarClamshell" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <script type="text/javascript">
        function agregaDatosClamshell(idclamshell) {
            $.ajax({
                type: "POST",
                data: "idart=" + idclamshell,
                url: "../procesamiento/clamshell/obtenDatosClamshell.php",
                success: function (r) {
                    dato = jQuery.parseJSON(r);
                    $('#idclamshell').val(dato['id_empaque']);
                    $('#codigoCU').val(dato['code_bgr']);
                    $('#NombreCU').val(dato['nombre']);
                    $('#DescripcionCU').val(dato['descripcion']);
                    $('#SaldoCU').val(dato['saldo']);
                    $('#UnidadU').val(dato['PrecioUnidad']);
                }
            });
        }


        function eliminaClamshell(idclamshell) {
            alertify.confirm('¿Desea eliminar ?', function () {
                $.ajax({
                    type: "POST",
                    data: "idClamshells=" + idclamshell,
                    url: "../procesamiento/clamshell/eliminarClamshell.php",
                    success: function (r) {
                        if (r == 1) {
                            $('#tablaClamshellLoad').load("clamshell/tablaClamshell.php");

                            alertify.success("Eliminado con exito!!");
                        } else {
                            alertify.error("No se pudo eliminar :(");
                        }
                    }
                });
            }, function () {
                alertify.error('Cancelo !')
            });
        }

    </script>




    <script type="text/javascript">
        $(document).ready(function () {
            $('#btnActualizarClamshell').click(function () {

                datos = $('#frmClamshellU').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/clamshell/ActualizaClamshell.php",
                    success: function (r) {
                        if (r == 1) {
                            $('#tablaClamshellLoad').load("clamshell/tablaClamshell.php");

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
            $('#tablaClamshellLoad').load("clamshell/tablaClamshell.php");

            $('#btnAgregarClamshell').click(function () {
                vacios = validarFormVacio('frmClamshell');

                if (vacios > 0) {
                    alertify.alert("Tienes que llenar todos los campos");
                    return false;
                }
                datos = $('#frmClamshell').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/clamshell/agregaClamshell.php",
                    success: function (r) {
                        alert(r);
                        if (r == 1) {
                            alertify.success("agregado con exito");
                        } else {
                            alertify.error("error al agregar");
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