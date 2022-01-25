<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>

<div class="container section">
    <div class="row">
        <h5 class="title">Solicitudes para procesos de adiestramiento pendientes</h5>
    <table class="responsive-table  z-depth-3 centered striped">
        <thead class="table-head">
            <th>Unidad Solicitante</th>
            <th>Gerente</th>
            <th>Fecha de la solicitud</th>
            <th>Método</th>
            <th>Denominación</th>
            <th>Número de Participantes</th>
            <th>Revisar</th>
        </thead>
        <tbody>
            <?php
            while($s = $solicitudes->fetch_assoc()){
                $participantes = ($bd->query("SELECT * FROM participante_adiestramiento 
                                    WHERE id_adiestramiento = ".$s["id_adiestramiento"]))->num_rows;
            ?>
                <tr>
                    <td><?php echo $s["departamento"] ?></td>
                    <td><?php echo $s["nombre"]." ".$s["apellido"] ?></td>
                    <td><?php echo $s["fecha_solicitud"] ?></td>
                    <td><?php echo $s["metodo"] ?></td>
                    <td><?php echo $s["denominacion"] ?></td>
                    <td><?php echo $participantes ?></td>
                    <td><a class="btn btn-flat" href="solicitudes_adiestramiento/<?php echo $s["id_adiestramiento"] ?>">
                        <i class="material-icons">visibility</i></a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    </div>
</div>
    

<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>