<?php
require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();

$sql = " SELECT sal.id_salidas, 
    sal.cantidad, 
    sal.Folio, 
    sal.code_brg, 
    sal.fechaCompra,
     ber.nombre,
       ber.descripcion,
       ber.capacidad,
       cli.nombre,
                (ber.capacidad* sal.cantidad )+ sal.piezas as total

       FROM salidas sal
       INNER JOIN berries ber ON sal.id_berrie = ber.id_berrie
       INNER JOIN clientes cli on sal.id_cliente = cli.id_cliente;
       ";

$result = mysqli_query($conexion, $sql);
?>
<div class="table-responsive">
    <div class="input-group">
        <span style="border: 2px solid DodgerBlue;" class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Escribe el producto que deseas buscar...">
    </div>
    <p></p>
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
        <tr>
        <thead style="background-color: #0c5460;color: white; font-weight: bold;">

        <td>Folio</td>
        <td>Codigo pro</td>
        <td>Nombre</td>
        <td>Descripcion</td>
        <td>Cantidad</td>
        <td>Piezas</td>
        <td>Fecha Salida</td>
        <td>Cliente</td>
                <td>Total piezas</td>

        <td>Editar</td>
        <td>Eliminar</td>
        </thead>
        </tr>
        <tfoot style="background-color: #0c5460;color: white; font-weight: bold;">
        <td>Folio</td>
        <td>Codigo pro</td>
        <td>Nombre</td>
        <td>Descripcion</td>
        <td>Cantidad</td>
        <td>Piezas</td>
        <td>Fecha Salida</td>
        <td>Cliente</td>
                <td>Total piezas</td>

        <td>Editar</td>
        <td>Eliminar</td>
        </tfoot>
        <?php while ($ver = mysqli_fetch_row($result)): ?>
            <tr>
            <tbody  class="buscar">

            <td><?php echo $ver[2]; ?></td>
            <td><?php echo $ver[3]; ?></td>
            <td><?php echo $ver[5]; ?></td>
            <td><?php echo $ver[6]; ?></td>
            <td><?php echo $ver[1]; ?></td>
            <td><?php echo $ver[7]; ?></td>
            <td><?php echo $ver[4]; ?></td>
            <td><?php echo $ver[8]; ?></td>
                        <td><?php echo $ver[9]; ?></td>


            <td>
                <span data-toggle="modal" data-target="#updatesalidas" class="btn btn-warning btn-xs" onclick="agregaDatosSalidas('<?php echo $ver[0] ?>')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </span>
            </td>
            <td>
                <span class="btn btn-danger btn-xs" onclick="eliminaSalidas ('<?php echo $ver[0] ?>')">
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