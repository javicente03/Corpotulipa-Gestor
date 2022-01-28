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
            <div class="row cont-crear">
                <form id="form">
                    <h5 class="title">Crear Nuevo Departamento</h5>
                    <div class="input-field col s12 m6">
                        <input type="text" name="siglas" id="siglas">
                        <label for="siglas">Siglas</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="nombre" id="nombre">
                        <label for="nombre">Nombre del Departamento</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="sede" id="sede">
                            <option value="Pueblo Nuevo">Pueblo Nuevo</option>
                            <option value="Punto Fijo">Punto Fijo</option>
                        </select>
                    </div>
                    <div class="input-field col s12 m6">
                        <button type="submit" class="btn-entrar" id="btn-submit">Crear</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </form>
                <div class="col s12">
                    <h5 class="title title-table">Departamentos Existentes</h5>
                    <table id="tabla" class="striped responsive-table z-depth-3 centered">
                        <thead class="table-head">
                            <th>Siglas</th>
                            <th>Nombre</th>
                            <th>Sede</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($data = $proceso->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $data["siglas"] ?></td>
                                    <td><b><?php echo $data["departamento"] ?></b></td>
                                    <td><?php echo $data["sede"] ?></td>
                                    <td><a href="editar_departamento/<?php echo $data["departamento_id"]; ?>" class="btn btn-flat indigo-text text-darken-4" style="font-weight: bold;">
                                            <i class="material-icons">edit</i></a></td>
                                    <td><button type="button" class="btn pink darken-4 waves-effect waves-light" onclick="eliminar(<?php echo $data['departamento_id'] ?>)">
                                            <i class="material-icons">delete</i></button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
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

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'departamentos',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok") {
                    location.href = ""
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
        option = confirm("¿Seguro desea eliminar este departamento?");
        if (option) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'eliminar_departamento',
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