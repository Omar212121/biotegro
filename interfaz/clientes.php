<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>Clientes</title>
            <?php require_once "menu.php"; ?>

        </head>

        <body>
            <div class="container">
                <h1>Clientes</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <form id="frmClientes">
                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" id="nombre" name="nombre">
                            <label>Email</label>
                            <input type="text" class="form-control input-sm" id="email" name="email">
                            <label>Telefono</label>
                            <input type="text" class="form-control input-sm" id="telefono" name="telefono">
                            <p></p>
                            <span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
                        </form>
                    </div>
                    <div class="col-sm-8">
                        <div id="tablaClientesLoad"></div>
                    </div>
                </div>

            </div>






        </body>


    </html>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#tablaClientesLoad').load("clientes/tablaClientes.php");

            $('#btnAgregarCliente').click(function () {

                vacios = validarFormVacio('frmClientes');

                if (vacios > 0) {
                    alertify.alert("Debes llenar todos los campos!!");
                    return false;
                }

                datos = $('#frmClientes').serialize();

                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/clientes/agregarClientes.php",
                    success: function (r) {
                        alert(r)
                        if (r == 1) {
                            $('#frmClientes')[0].reset();
                            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                            alertify.success("Cliente agregado con exito");
                        } else {
                            alertify.error("No se pudo agregar cliente");
                        }
                    }
                });
            });
        });
        
        
            function eliminarCliente(idcliente) {
            alertify.confirm('¿Seguro que desea eliminar este cliente?', function () {
                $.ajax({
                    type: "POST",
                    data: "idcliente=" + idcliente,
                    url: "../procesamiento/clientes/eliminarCliente.php",
                    success: function (r) {
                        if (r == 1) {
                            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                            alertify.success("se ha eliminado el cliente con exito");
                        } else {
                            alertify.error("error al eliminar el cliente");
                        }
                    }
                });
            }, function () {
                alertify.error('Cancelo')
            });
        }
        
        
        
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#btnAgregarClienteU').click(function () {
                datos = $('#frmClientesU').serialize();

                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/clientes/actualizaCliente.php",
                    success: function (r) {

                        if (r == 1) {
                            $('#frmClientes')[0].reset();
                            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                            alertify.success("Cliente actualizado con exito :D");
                        } else {
                            alertify.error("No se pudo actualizar cliente");
                        }
                    }
                });
            })
        })
    
    </script>
    
    <?php
} else {

    header("location:../index.php");
}
?>




