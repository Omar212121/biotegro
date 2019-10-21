<?php
session_start();
if (isset($_SESSION['usuario'])and $_SESSION['usuario'] == 'admin') {
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>usuarios</title>
            <?php require_once "menu.php"; ?>

        </head>

        <body>
            <div class="container">
                <h1>Control de Usuarios</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <form id="frmRegistro">
                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" name="nombre" id="nombre">
                            <label>Apellido</label>
                            <input type="text" class="form-control input-sm" name="apellido" id="apellido">
                            <label>Usuario</label>
                            <input type="text" class="form-control input-sm" name="usuario" id="usuario">
                            <label>Password</label>
                            <input type="text" class="form-control input-sm" name="password" id="password">
                            <p></p>
                            <span class="btn btn-primary" id="registro">Registrar</span>
                        </form>
                    </div>
                    <div class="col-sm-7">
                        <div id="tablaUsuariosLoad"></div>
                    </div>
                </div>

            </div>
          


        </body>


    </html>
   

    <script type="text/javascript">
        $(document).ready(function () {

            $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
            $('#registro').click(function () {

                vacios = validarFormVacio('frmRegistro');

                if (vacios > 0) {
                    alertify.alert("Debes llenar todos los campos!!");
                    return false;
                }

                datos = $('#frmRegistro').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "procesamiento/proLogin/registrarUsuario.php",
                    success: function (r) {


                        if (r == 1) {
                            $('#frmRegistro')[0].reset();
                            $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
                            alertify.success("Usuario agregado con exito");
                        } else {
                            alertify.error("error al agregar");
                        }
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#registro').click(function () {

                vacios = validarFormVacio('frmRegistro');

                if (vacios > 0) {
                    alertify.alert("tienes que llenar todos los campos");
                    return false;
                }

                datos = $('#frmRegistro').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/proLogin/registrarUsuario.php",
                    success: function (r) {
                        //alert(r);

                        if (r == 1) {
                            $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');

                            alertify.success("Agregado con exito");
                        } else {
                            alertify.error("Fallo al agregar :(");
                        }
                    }
                });
            });
        });
        
        	function eliminaUsuario(idusuario){
			alertify.confirm('¿Seguro que desea eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesamiento/usuarios/eliminarUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
							alertify.success("Usuario Eliminado con exito");
						}else{
							alertify.error("error al eliminar");
						}
					}
				});
			}, function(){ 
				alertify.error('Se cancelo la eliminacion del usuario')
			});
		}
        
        
    </script>

    <?php
} else {
    header("location:../index.php");
}
?>