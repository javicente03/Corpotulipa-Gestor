<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");
?>

<div class="container section">
    <div class="row">
        <h5 class="title title-table">Movimientos pendientes por revisión</h5>
        <table id="tabla" class="striped responsive-table z-depth-3 centered">
        <thead class="table-head">
            <th>Fecha del Prestamo</th>
            <th>Nombre del Bien</th>
            <th>Código</th>
            <th>Solicitante</th>
            <th>Duración</th>
            <th>Revisar</th>
        </thead>
        <tbody>
        <?php
            while ($prestamo = $prestamos->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $prestamo["fecha_prestamo"] ?></td>
                <td><?php echo $prestamo["nombre_bien"] ?></td>
                <td><?php echo $prestamo["codigo"] ?></td>
                <td><?php echo $prestamo["nombre"]." ".$prestamo["apellido"] ?></td>
                <td><?php echo $prestamo["duracion"] ?> días</td>
                <td><a class="btn btn-flat" href="movimiento_bienes/<?php echo $prestamo["id_prestamo_bien"] ?>">
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
<script src="frontend/js/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabla').DataTable({
            "language": {
                "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "No hay data registrada",
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