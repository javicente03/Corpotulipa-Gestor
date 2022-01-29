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
                <h5 class="title title-table">Bienes reportados</h5>
                <table id="tabla" class="striped responsive-table z-depth-3 centered">
                    <thead class="table-head">
                        <th>Nombre del Bien</th>
                        <th>Código</th>
                        <th>Responsable</th>
                        <th>Causa</th>
                        <th>Descripción de la falta</th>
                        <th>Revisar</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($reporte = $reportes->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $reporte["nombre_bien"] ?></td>
                                <td><?php echo $reporte["codigo"] ?></td>
                                <td><?php echo $reporte["nombre"] . " " . $reporte["apellido"] ?></td>
                                <td><?php echo $reporte["motivo_reporte"] ?></td>
                                <td>
                                    <div class="scroll-td" style="width: 350px;"><?php echo $reporte["descripcion_reporte"] ?></div>
                                </td>
                                <td><a class="btn btn-flat" href="bienes_faltantes/<?php echo $reporte["id_reporte_bien"] ?>">
                                        <i class="material-icons">visibility</i></a></td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>
<script src="frontend/js/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabla').DataTable({
            "language": {
                "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "No hay data encontrada",
                "info": "Total: _MAX_ resultados",
                "infoEmpty": "No hay coincidencias",
                "infoFiltered": "",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>

<?php
include("frontend/modularizacion/cierre_html.php");
?>