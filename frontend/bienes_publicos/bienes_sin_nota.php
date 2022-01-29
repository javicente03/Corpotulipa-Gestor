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
                <h5 class="title title-table">Bienes públicos sin nota de entrega</h5>
                <table id="tabla" class="stripped responsive-table z-depth-3 centered">
                    <thead class="table-head">
                        <th>Fecha de incorporación</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Valor</th>
                        <th>Responsable</th>
                        <th>Nota de Entrega</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($b = $bienes->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $b['fecha_incorporacion'] ?></td>
                                <td><?php echo $b['codigo'] ?></td>
                                <td><?php echo $b['tipo'] ?></td>
                                <td><?php echo $b['nombre_bien'] ?></td>
                                <td><?php echo $b['valor'] ?></td>
                                <td><?php echo $b['nombre'] . " " . $b["apellido"] ?></td>
                                <td><a class="btn indigo darken-3" href="generar_nota_entrega/<?php echo $b['id_bien'] ?>">
                                        <i class="material-icons">assignment</i></a></td>
                            </tr>
                        <?php } ?>
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