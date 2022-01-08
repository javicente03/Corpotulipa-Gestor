<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>
<div class="container section">
    <div class="row">
        <div class="col s12">
            <div class="row cont-crear">
                <form id="form">
                    <h5 class="title">Generar Usuario</h5>
                    <div class="input-field col s12 m6">
                        <input type="text" name="cedula" id="cedula">
                        <label for="cedula" style="font-weight: bold;">Cédula</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="nombre" id="nombre">
                        <label for="nombre">Nombres</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="apellido" id="apellido">
                        <label for="apellido">Apellidos</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="email" name="email" id="email">
                        <label for="email">Correo Electrónico</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <div class="row">
                            <div class="col s12 m4">
                                <p>
                                    <label>
                                        <input type="radio" class="with-gap" name="genero" id="masculino" value="Masculino" onclick="s(1)">
                                        <span>Masculino</span>
                                    </label>
                                </p>
                            </div>
                            <div class="col s12 m4">
                                <p>
                                    <label>
                                        <input type="radio" class="with-gap" name="genero" id="femenino" value="Femenino" onclick="s(1)">
                                        <span>Femenino</span>
                                    </label>
                                </p>
                            </div>
                            <div class="col s12 m4">
                                <p>
                                    <label>
                                        <input type="radio" class="with-gap" name="genero" id="otro" value="Otro" onclick="s(2)">
                                        <span>Otro</span>
                                    </label>
                                </p>
                            </div>
                            <div class="col s12">
                                <input type="text" name="other" id="other" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="departamento" id="departamento">
                            <?php
                            while ($departamentos = $proceso->fetch_assoc()) {
                                echo "<option value='" . $departamentos['departamento_id'] . "'>" . $departamentos['siglas'] . "</option>";
                            }
                            ?>
                        </select>
                        <label>Seleccione un departamento</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="cargo" id="cargo">
                            <?php
                            while ($cargos = $proceso1->fetch_assoc()) {
                                echo "<option value='" . $cargos['cargo_id'] . "'>" . $cargos['cargo'] . "</option>";
                            }
                            ?>
                        </select>
                        <label>Indique el cargo</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="date" name="nacimiento" id="nacimiento">
                        <label for="nacimiento">Fecha de Nacimiento</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <button type="submit" class="btn-entrar" id="btn-submit">Crear</button>
                    </div>
                    <div class="progress indigo darken-4" id="progress" style="display: none;">
                        <div class="indeterminate"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container section">
    <h5 class="title title-table">Usuarios Existentes</h5>
    <table id="tabla" class="striped responsive-table z-depth-3 centered">
        <thead class="table-head">
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Cargo</th>
            <th>Departamento</th>
            <th>Acción</th>
            <th>Acción</th>
        </thead>
        <tbody>
            <?php
            while ($usuarios = $proceso2->fetch_assoc()) {

            ?>
                <tr>
                    <td><?php echo $usuarios["nombre"] ?></td>
                    <td><?php echo $usuarios["apellido"] ?></td>
                    <td><?php echo $usuarios["email"] ?></td>
                    <td><?php echo $usuarios["cargo"] ?></td>
                    <td><?php echo $usuarios["siglas"] ?></td>
                    <td>
                        <a href="editar_usuario/<?php echo $usuarios["id"]; ?>" title="Editar"
                        class="btn btn-flat indigo-text text-darken-4" style="font-weight: bold;">
                        <i class="material-icons prefix">edit</i></a>
                    </td>
                    <td>
                        <button type="button" id="btn-submit" class="btn indigo darken-4 waves-effect waves-light"
                            onclick="suspender(<?php echo $usuarios['id'] ?>, <?php if ($usuarios['status'] == 'active') echo '1';
                                                else echo '0';  ?>)"><?php if ($usuarios['status'] == 'active') echo 'Suspender';
                                                else echo 'Reactivar';  ?></button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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
                
    function s(i) {
        if (i == 1) {
            document.getElementById("other").disabled = true
            document.getElementById("other").value = ""
            document.getElementById("other").placeholder = ""
        } else {
            document.getElementById("other").disabled = false
            document.getElementById("other").placeholder = "Ingrese un genero"
        }
    }

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'generar_usuario',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response.substring(response.length - 2, response.length) == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "";
                } else {
                    M.toast({
                        html: response,
                        classes: 'rounded red'
                    })
                    $("#progress").css("display", "none")
                    $("#btn-submit").prop('disabled', false)
                }
            }
        });
    });

    function suspender(id, x) {
        if (x == "1") {
            var accion = "suspended"
            var option = confirm("¿Seguro desea suspender a este usuario?")
        } else {
            var accion = "active"
            var option = confirm("¿Seguro desea reactivar a este usuario?")
        }
        if (option) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'suspender_usuario',
                data: {
                    id: id,
                    accion: accion
                },
                success: function(response) {

                    if (response == "ok") {
                        location.href = ""
                    } else if (response == "¡Oh no, ocurrió un error inesperado!" ||
                        response == "Estatus no válido" || response == "Debe completar los datos correctamente") {
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                    } else {
                        location.href = "sesion"
                    }
                }
            });
        }
    }
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>