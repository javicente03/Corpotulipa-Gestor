<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");
?>

<div class="row">
    <?php include("frontend/modularizacion/lateral.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="container section">
            <div class="row">
                <h5 class="title title-table">Bienes prestados actualmente</h5>
                <table id="tabla" class="striped responsive-table centered blue lighten-5">
                    <thead class="table-head">
                        <th>Nombre del Bien</th>
                        <th>Código</th>
                        <th>Responsable</th>
                        <th>Fecha del Prestamo</th>
                        <th>Duración</th>
                        <th>Días Restantes</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        while ($prestamo = $prestamos->fetch_assoc()) {
                            $date = date("Y-m-d");
                            $tramite = date_create($prestamo["fecha_tramite"]);
                            $date = date_create($date);
                            $interval = date_diff($tramite, $date);
                            $transcurridos = $interval->format('%a');
                            $restante = $prestamo["duracion"] - $transcurridos;
                        ?>
                            <tr>
                                <td><?php echo $prestamo["nombre_bien"] ?></td>
                                <td><?php echo $prestamo["codigo"] ?></td>
                                <td><?php echo $prestamo["nombre"] . " " . $prestamo["apellido"] ?></td>
                                <td><?php echo $prestamo["fecha_tramite"] ?></td>
                                <td><?php echo $prestamo["duracion"] ?></td>
                                <td><?php echo $restante ?></td>
                                <td><a class="btn btn-flat" href="bienes_prestados/<?php echo $prestamo["id_tramite_bien"] ?>">
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