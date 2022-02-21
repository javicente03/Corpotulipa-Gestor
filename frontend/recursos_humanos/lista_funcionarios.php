<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>
<div class="row">
    <?php include("frontend/modularizacion/lateral.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <h5 class="title title-table">Usuarios Existentes</h5>
            <table id="tabla" class="striped responsive-table z-depth-3 centered">
                <thead class="table-head">
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Cargo</th>
                    <th>Ver</th>
                </thead>
                <tbody>
                    <?php
                    while ($row = $funcionarios->fetch_assoc()) {

                    ?>
                        <tr>
                            <td><?php echo $row["nombre"] ?></td>
                            <td><?php echo $row["apellido"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><?php echo $row["cargo"] ?></td>
                            <td>
                                <a href="lista_funcionarios/<?php echo $row["id"]; ?>" title="Ver" class="btn btn-flat indigo-text text-darken-4" style="font-weight: bold;">
                                    <i class="material-icons prefix">visibility</i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/datatables.min.js"></script>
<script src="frontend/js/notificaciones.js"></script>

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