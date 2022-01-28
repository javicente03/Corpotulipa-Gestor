<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");
?>

<div class="row">
    <?php include("frontend/modularizacion/lateral.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <div class="row">
                <h5 class="title">Solicitud de reposición de caja chica</h5>
                <table class="stripped responsive-table z-depth-3 centered">
                    <thead class="table-head">
                        <th>Número de Reposición</th>
                        <th>Fecha</th>
                        <th>Fondo CC <small>(Para ese momento)</small></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        while ($data = $solicitudes->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $data['id_solicitud_repo_cc'] ?></td>
                                <td><?php echo $data['fecha'] ?></td>
                                <td><?php echo $data['fondo_momento'] ?></td>
                                <td><a class="btn btn-flat" href="gerencia_repo_cc/<?php echo $data['id_solicitud_repo_cc'] ?>">
                                        <i class="material-icons left">visibility</i>Revisar</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div style="display: flex;justify-content: center;">
                    <div class="cont-caja-chica">
                        <h4 class="title" style="text-align: center;">Fondo Actual de Caja Chica</h4>
                        <h3 class="title" style="text-align: center;"><?php echo $cc['fondo_actual'] ?> <small>UT</small></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>

<?php
include("frontend/modularizacion/cierre_html.php");
?>