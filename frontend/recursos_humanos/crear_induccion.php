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
                <h5 class="title">Solicitar Charla de Inducción</h5>
                <form id="form">
                    <div class="input-field col s12 m6">
                        <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                        <input type="password" id="clave" name="clave" required>
                        <label for="clave">Ingrese su clave de seguridad</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="date" name="fecha" id="fecha" required>
                        <label for="fecha">Fecha de la Inducción</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="responsable" id="responsable">
                            <?php
                            while ($r = $responsables->fetch_assoc()) {
                                echo "<option data-icon='" . $r["img"] . "' value='" . $r["id"] . "'>" . $r["apellido"] . " " . $r["nombre"] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="responsable">Indique el encargado</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <table id="tabla" class="striped responsive-table centered blue lighten-5">
                    <thead class="table-head">
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Cargo</th>
                        <th>Invitar</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($array as $key => $value) { ?>
                            <tr>
                                <td>
                                    <?php echo $value["nombre"] ?>
                                </td>
                                <td>
                                    <?php echo $value["apellido"] ?>
                                </td>
                                <td>
                                    <?php echo $value["cargo"] ?>
                                </td>
                                <td>
                                    <p><label>
                                            <input type="checkbox" class="filled-in" id="user<?php echo $value["id"] ?>" onclick="marcado(<?php echo $value['id'] ?>)">
                                            <span></span>
                                        </label></p>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <p class="parrafo"><i class="material-icons left">error</i>Por favor seleccione a los
                    participantes de la inducción, así como al encargado de realizarla.</p>
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

    var array = Array()
    console.log(array)

    function marcado(id) {
        if (document.getElementById("user" + id).checked)
            array.push(id)
        else {
            var pos = array.indexOf(id)
            array.splice(pos, 1)
        }
    }

    function visualizar() {
        var pass = document.getElementById("clave");
        var icon = document.getElementById("icon");

        if (pass.getAttribute("type", "password") == "password") {
            pass.setAttribute("type", "text")
            icon.innerHTML = "visibility_off"
        } else {
            pass.setAttribute("type", "password")
            icon.innerHTML = "visibility"
        }
    }

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        var formData = new FormData(document.getElementById("form"));
        formData.append('array', JSON.stringify(array));
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'charla_induccion',
            data: formData,
            enctype: 'application/x-www-form-urlencoded',
            processData: false, // tell jQuery not to process the data
            contentType: false,
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
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>