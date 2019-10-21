<?php
session_start();
if (isset($_SESSION['usuario'])) {
    require_once "../clases/Conexion.php";
    $c = new conectar();
    $conexion = $c->conexion();
    $sql = "SELECT ent.id_entrada,
ent.code_brg,
ent.fechaCaptura,
ent.cantidad,
berr.nombre,
berr.descripcion,
berr.capacidad,
berr.stock,
( ent.cantidad  * berr.capacidad)as total 
from entrada as ent inner join berries as berr 
                on ent.id_berrie= berr.id_berrie
                UNION
SELECT sal.id_salidas,
sal.code_brg,
sal.fechaCompra,
sal.cantidad,
ber.nombre,
ber.descripcion,
ber.capacidad,
ber.stock,
 ( sal.cantidad  * ber.capacidad)as total 

from salidas as sal inner join berries as ber
                on sal.id_berrie= ber.id_berrie";
    $result = mysqli_query($conexion, $sql);
    ?>
    <?php require_once "menu.php"; ?>

<div
    

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
                    <td>Entrada/Salida</td>

                    <td>Codigo P</td>

                    <td>Nombre</td>

                    <td>Descripcion</td>

                    <td>cantidad</td>

                    <td>piezas</td>

                    <td>Total piezas</td>
            <td>Stock</td>

                    <td>fecha Entrada/salida</td>
                     <td>Editar</td>

                <td>eliminar</td>

            </thead>
            </tr>
            <tfoot style="background-color: #0c5460;color: white; font-weight: bold;">
            <td>Entrada/Salida</td>

            <td>Codigo P</td>

            <td>Nombre</td>

            <td>Descripcion</td>

            <td>cantidad</td>

            <td>piezas</td>

            <td>Total piezas</td>
            <td>Stock</td>


            <td>fechaE</td>
             <td>Editar</td>

                <td>eliminar</td>

            </tr>

            </tfoot>
            <?php while ($ver = mysqli_fetch_row($result)): ?>
                <tbody class="buscar">
                    <tr>
                        <td><?php echo $ver[0]; ?></td>
                        <td><?php echo $ver[1]; ?></td>
                        <td><?php echo $ver[4]; ?></td>
                        <td><?php echo $ver[5]; ?></td>
                        <td><?php echo $ver[3]; ?></td>
                        <td><?php echo $ver[6]; ?></td>
                        <td><?php echo $ver[8]; ?></td>

                        <td><?php echo $ver[7]; ?></td>
                        <td><?php echo $ver[2]; ?></td>

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

        <?php
    }else {
        header("location:../index.php");
    }
    ?>
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