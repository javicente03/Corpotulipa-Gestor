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
            <div class="row">
                <h5 class="title title-table">Solicitudes de Adiestramiento por aprobar</h5>
                <table id="tabla" class="responsive-table striped z-depth-3 centered">
                    <thead class="table-head">
                        <th>Unidad Solicitante</th>
                        <th>Gerente</th>
                        <th>Fecha Pautada</th>
                        <th>Método</th>
                        <th>Denominación</th>
                        <th>Número de Participantes</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        while ($s = $solicitudes->fetch_assoc()) {
                            $participantes = ($bd->query("SELECT * FROM participante_adiestramiento 
                                    WHERE id_adiestramiento = " . $s["id_adiestramiento"]))->num_rows;
                        ?>
                            <tr>
                                <td><?php echo $s["departamento"] ?></td>
                                <td><?php echo $s["nombre"] . " " . $s["apellido"] ?></td>
                                <td><?php echo $s["fecha_adiestramiento"] ?></td>
                                <td><?php echo $s["metodo"] ?></td>
                                <td><?php echo $s["denominacion"] ?></td>
                                <td><?php echo $participantes ?></td>
                                <td><a class="btn btn-flat" href="aprobar_adiestramiento/<?php echo $s["id_adiestramiento"] ?>"><i class="material-icons">visibility</i></a></td>
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