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
                <div class="col s12">
                    <table id="tabla" class="striped z-depth-3 centered">
                        <thead class="table-head">
                            <th>Solicitante</th>
                            <th>Monto en Bs</th>
                            <th>Unidades Tributarias</th>
                            <th>Fecha de la solicitud</th>
                            <th>Motivo</th>
                            <th>Acción</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($data = $ejecutar->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $data['nombre'] . " " . $data['apellido'] ?></td>
                                    <td><?php echo $data['bs'] ?></td>
                                    <td><?php echo $data['ut_pedido'] ?></td>
                                    <td><?php echo $data['fecha'] ?></td>
                                    <td>
                                        <div class="scroll-td"><?php echo $data['motivo'] ?></div>
                                    </td>
                                    <td><button class="btn indigo darken-4 waves-effect waves-light" onclick="aceptar(<?php echo $data['id_sol_cc'] ?>)"><i class="material-icons">check</i></button>
                                        <button class="btn pink darken-4 waves-effect waves-light" onclick="descartar(<?php echo $data['id_sol_cc'] ?>)"><i class="material-icons">close</i></button>
                                    </td>
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

    function aceptar(id) {
        var option = confirm("¿Seguro que desea aceptar esta solicitud?")
        if (option) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'solicitudes_cc',
                data: {
                    id: id,
                    method: 'ac'
                },
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>")
                        location.href = ""
                    else
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                }
            });
        }
    }

    function descartar(id) {
        var option = confirm("¿Seguro que desea descartar esta solicitud?")
        if (option) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'solicitudes_cc',
                data: {
                    id: id,
                    method: 'dc'
                },
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>")
                        location.href = ""
                    else
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                }
            });
        }
    }
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>