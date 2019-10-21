<?php
require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();
$sql = "
                SELECT art.cantidad,                     
                pro.nombre, 
                pro.descripcion, 
                pro.id_categoria, 
                pro.presentacion, 
                pro.capacidad, 
                art.id_entrada,
                art.fechaCaptura,
                art.Folio,
                art.code_brg,
                (pro.capacidad* art.cantidad )+ art.piezas as total,
                art.piezas
                from entrada as art inner join berries as pro 
                on art.id_berrie= pro.id_berrie";

$result = mysqli_query($conexion, $sql);
?>
<div class="table-responsive">
    <div class="input-group">
        <span style="border: 2px solid DodgerBlue;" class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Escribe el producto que deseas buscar...">
    </div>
    <p></p>
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
        <caption></caption>
        <thead style="background-color: #0c5460;color: white; font-weight: bold;">

            <tr>
                <td>Folio</td>
                <td>Codigo P</td>

                <td>Nombre</td>

                <td>Descripcion</td>

                <td>cantidad</td>

                 <td>piezas</td>

                <td>Total</td>

                <td>fechaE</td>

                <td>Editar</td>

                <td>eliminar</td>
        </thead>
        </tr>
        <tfoot style="background-color: #0c5460;color: white; font-weight: bold;">
        <td>Folio</td>
        <td>Codigo P</td>

        <td>Nombre</td>

        <td>Descripcion</td>

        <td>cantidad</td>
         <td>piezas</td>

        <td>Total</td>

        <td>fechaE</td>



        <td>Editar</td>

        <td>eliminar</td>
        </tr>

        </tfoot>
        <?php while ($ver = mysqli_fetch_row($result)): ?>
            <tbody class="buscar">
                <tr>
                    <td><?php echo $ver[8]; ?></td>

                    <td><?php echo $ver[9]; ?></td>

                    <td><?php echo $ver[1]; ?></td>

                    <td><?php echo $ver[2]; ?></td>

                    <td><?php echo $ver[0]; ?></td>

                    <td><?php echo $ver[5]; ?></td>
                     
                    <td><?php echo $ver[10]; ?></td>
                    <td><?php echo $ver[7]; ?></td>

         


                    <td>
                        <span data-toggle="modal" data-target="#abremodalUpdateEntrada" class="btn btn-warning btn-xs" onclick="agregaDatosEntrada('<?php echo $ver[6]  ?>')" >
                            <span class="glyphicon glyphicon-pencil"></span>
                        </span>
                    </td>
                    <td>
                                             

                        <span class="btn btn-danger btn-xs" onclick="eliminaEntrada('<?php echo $ver[6]; ?>')">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                                                                            

                    </td>

                </tr>
            </tbody>
        <?php endwhile; ?>
    </table>

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