<?php 
require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();
$sql = "SELECT nombre, email,telefono from clientes";
$result = mysqli_query($conexion, $sql);

 ?>
<div class="row">
     <div class="input-group">
        <span style="border: 2px solid DodgerBlue;" class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Escribe el producto que deseas buscar...">
    </div>
	<div class="col-sm-12">
	<h2>Tabla dinamica facultad autodidacta</h2>
		<table class="table table-hover table-condensed table-bordered">
		<caption>
			
		</caption>
			<tr>
				<td>Nombre</td>
				<td>Email</td>
				<td>Telefono</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>

		        <?php while ($ver = mysqli_fetch_row($result)): ?>


			<tr>
				<td><?php echo $ver[0] ?></td>
				<td><?php echo $ver[1] ?></td>
				<td><?php echo $ver[2] ?></td>
				<td>
					<button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">
						
					</button>
				</td>
				<td>
					<button class="btn btn-danger glyphicon glyphicon-remove" 
					onclick="preguntarSiNo('<?php echo $ver[0] ?>')">
						
					</button>
				</td>
			</tr>
			
			 
		</table>
                <?php endwhile; ?>

	</div>
</div>
 <script type="text/javascript">

        $(document).ready(function () {

            (function ($) {

                $('#filtrar').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();

                })

            }(jQuery));

        });
    </script>