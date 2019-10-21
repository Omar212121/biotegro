<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>


    <!DOCTYPE html>
    <html>
        <head>
            <title>categorias</title>
            <?php require_once "menu.php"; ?>
        </head>
        <body>

            <div class="container">
                <h1>Categorias</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <form id="frmCategorias">
                            <label>Categoria</label>
                            <input type="text" class="form-control input-sm" name="categoria" id="categoria">
                            <p></p>
                            <span class="btn btn-primary" id="btnAgregaCategoria">Agregar</span>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div id="tablaCategoriaLoad"></div>
                    </div>
                </div>
            </div>

        <div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza categorias</h4>
					</div>
					<div class="modal-body">
						<form id="frmCategoriaU">
							<input type="text" hidden="" id="idcategoria" name="idcategoria">
							<label>Categoria</label>
							<input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm">
                                                        
						</form>


					</div>
					<div class="modal-footer">
                                            <button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Guardar</button>

					</div>
				</div>
			</div>
		</div>

	</body>

        </body>
    </html>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");

            $('#btnAgregaCategoria').click(function () {

                vacios = validarFormVacio('frmCategorias');

                if (vacios > 0) {
                    alertify.alert("Tienes que llenar todos los campos");
                    return false;
                }

                datos = $('#frmCategorias').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesamiento/categorias/agregaCategoria.php",
                    success: function (r) {
                        alert(r);
                        if (r == 1) {

                            $('#frmCategorias')[0].reset();

                            $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
                            alertify.success("Categoria agregada con exito ");
                        } else {
                            alertify.error("No se pudo agregar categoria");
                        }
                    }
                });
            });
        });
    </script>
    
    <script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaCategoria').click(function(){

				datos=$('#frmCategoriaU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesamiento/categorias/ActualizarCategorias.php",
					success:function(r){
                                            alert(r);
						if(r==1){
							$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
							alertify.success("Categorias actualizadas con exito");
						}else{
							alertify.error("no se pudo actualizar");
						}
					}
				});
			});
		});
	</script>
    

    <script type="text/javascript">
		function agregaDato(idCategoria,categoria){
			$('#idcategoria').val(idCategoria);
			$('#categoriaU').val(categoria);
		}

		function eliminaCategoria(identrada){
			alertify.confirm('¿Seguro que quiere eliminar?', function(){ 
				$.ajax({
					type:"POST",
					data:"identrada=" + identrada,
					url:"../procesamiento/categorias/eliminarcategoria.php",
					success:function(r){
						if(r==1){
							$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("error al eliminar");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}
	</script>
    <?php
} else {
    header("location:../index.php");
}
?>