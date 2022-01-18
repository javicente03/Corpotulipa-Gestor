<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");
?>
    
<div class="container section">
    <div class="row">
    <h5 class="title title-table">Inventario</h5>
            <table id="tabla" class="striped responsive-table centered blue lighten-5">
            <thead class="table-head">
            <th>Departamento</th>
            <th>Catalogo</th>
            <th>Nombre</th>
            <th>Sede</th>
            <th>Responsable</th>
            <th>Desincorporar</th>
        </thead>
        <tbody>
            <?php
                while ($bien = $bienes->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $bien["siglas"] ?></td>
                <td><?php echo $bien["catalogo"] ?></td>
                <td><?php echo $bien["nombre_bien"] ?></td>
                <td><?php echo $bien["sede"] ?></td>
                <td><?php echo $bien["nombre"]." ".$bien["apellido"] ?></td>
                <td><a class="bt btn-flat" href="desincorporar_bienes/<?php echo $bien["id_bien"] ?>">
                <i class="material-icons">close</i></a></td>
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