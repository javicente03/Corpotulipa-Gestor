<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>

<div class="container section">
    <div class="row cont-crear">
        <form id="form">
            <h5 class="title">Crear Nuevo Permiso</h5>
            <div class="col s12 m6 input-field">
                <select name="accion" id="accion">
                    <option value="Editar_UT_Caja_Chica">Editar UT Caja Chica</option>
                    <option value="Aceptar_Sol_CC">Aceptar Solicitud de Caja Chica</option>
                    <option value="Recepcion_Repo_CC">Recepción de Reposición de Caja Chica</option>
                    <option value="Coordinacion_Repo_CC">Coordinación de Reposición de Caja Chica</option>
                    <option value="Analisis_Repo_CC">Analisis de Reposición de Caja Chica</option>
                    <option value="Contador_Repo_CC">Contador de Reposición de Caja Chica</option>
                    <option value="Gerencia_Repo_CC">Gerencia Reposición de Caja Chica</option>
                    <option value="Incorporacion_Muebles">Incorporar Muebles e Inmuebles</option>
                    <option value="Generar_Nota">Generar Nota de Entrega Muebles e Inmuebles</option>
                    <option value="Prestar_Bien_Publico">Prestar Bienes Muebles e Inmuebles</option>
                    <option value="Movimiento_Bienes">Efectuar Movimiento Muebles e Inmuebles</option>
                    <option value="Reporte_Bien">Revision de Reportes Muebles Faltantes</option>
                    <option value="Desincorporar_Bien">Desincorporar Bien</option>
                    <option value="Programar_Inventario">Programar Levantamiento de Inventario</option>
                    <option value="Aprobar_Inventario">Aprobar Levantamiento de Inventario</option>
                    <option value="Levantar_Inventario">Levantar Inventario de la Unidad</option>
                    <option value="Recursos_Humanos">Recursos Humanos</option>
                    <option value="Solicitud_Adiestramiento">Solicitar Adiestramiento</option>
                    <option value="Revisar_Solicitud_Adiestramiento">Revisar Solicitudes de Adiestramiento</option>
                    <option value="Aprobar_Adiestramiento">Aprobar Adiestramiento</option>
                </select>
            </div>
            <div class="col s12 m6 input-field">
                <select name="cargo" id="cargo">
                    <?php
                    while ($cargos = $proceso1->fetch_assoc()) {
                        echo "<option value='" . $cargos['cargo_id'] . "'>" . $cargos['cargo'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col s12 input-field">
                <button type="submit" id="crear" class="btn-entrar" id="btn-submit">Crear</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </form>
        <div class="col s12">
            <table id="tabla" class="striped responsive-table z-depth-3 centered">
                <thead class="table-head">
                    <th>Acción</th>
                    <th>Cargo</th>
                    <th>Eliminar</th>
                </thead>
                <tbody>
                    <?php
                    while ($data = $proceso->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $data["accion"] ?></td>
                            <td><?php echo $data["cargo"] ?></td>
                            <td><button type="button" class="btn pink darken-4 waves-effect waves-light"
                                onclick="eliminar(<?php echo $data['permiso_id'] ?>)">
                                <i class="material-icons">delete</i></button></td>
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

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'permisos',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "";
                } else {
                    M.toast({
                        html: response,
                        classes: 'rounded red'
                    })
                    $("#progress").css("display", "none")
                    $("#btn-submit").prop('disabled', false)
                    $("#btn-submit").css('background', '#1a237e')
                }
            }
        });
    });

    function eliminar(id) {
        option = confirm("¿Seguro desea eliminar este Permiso?");
        if (option) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'eliminar_permiso',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                        location.href = ""
                    } else {
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                    }
                }
            });
        }
    }
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>