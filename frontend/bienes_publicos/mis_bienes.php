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
                <h5 class="title title-table">Bienes a tu responsabilidad</h5>
                <table id="tabla" class="striped z-depth-3 centered responsive-table">
                    <thead class="table-head">
                        <th>Nombre del Bien</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Revisar</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($bien = $bienes->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $bien["nombre_bien"] ?></td>
                                <td><?php echo $bien["codigo"] ?></td>
                                <td><?php echo $bien["tipo"] ?></td>
                                <td><a class="btn btn-flat" href="mis_bienes/<?php echo $bien["id_bien"] ?>">
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