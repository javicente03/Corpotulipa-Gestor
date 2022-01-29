<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");

if (isset($inventario)) {
    $realizado = ($bd->query("SELECT * FROM inventario_departamento 
                        WHERE id_inventario = " . $ultimo["id_inventario"] .
        " AND gerente = " . $_SESSION["id"]))->fetch_assoc();
    if ($realizado)
        echo "<h5 class='title'>Ya realizó su levantamiento de inventario pautado</h5>";
    else {
?>
        <div class="row">
            <?php include("frontend/modularizacion/lateral.php") ?>
            <div class="col m12 l9 contenido-principal">
                <div class="section">
                    <div class="row">
                        <h5 class="title">Levantar Inventario</h5>
                        <table id="tabla" class="striped responsive-table centered blue lighten-5">
                            <thead class="table-head">
                                <th>Código</th>
                                <th>Número de Identificación</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Valor</th>
                                <th>Existe</th>
                            </thead>
                            <tbody>
                                <?php

                                $total = 0;
                                while ($i = $inventario->fetch_assoc()) {

                                    $total += $i["valor"];
                                ?>
                                    <tr style="border-bottom: 1px solid #040729;">
                                        <td><?php echo $i["codigo"] ?></td>
                                        <td><?php echo $i["id_bien"] ?></td>
                                        <td><?php echo $i["nombre_bien"] ?></td>
                                        <td><?php echo $i["descripcion"] ?></td>
                                        <td><?php echo $i["valor"] ?></td>
                                        <td>
                                            <p><label>
                                                    <input class="filled-in" onchange="marcado(<?php echo $i['id_bien'] ?>)" checked type="checkbox" name="existe<?php echo $i["id_bien"] ?>" id="existe<?php echo $i["id_bien"] ?>">
                                                    <span></span>
                                                </label></p>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="indigo darken-4 white-text" style="border: 2px solid black;"><b>Total:</b></td>
                                <td class="indigo darken-4 white-text" style="border: 2px solid black;"><b><?php echo $total ?> Bs</b></td>
                                <td></td>
                            </tbody>
                        </table>
                        <p class="parrafo"><i class="material-icons left">error</i>
                            Por favor desmarque todos los bienes materiales que no se encuentren actualmente en su departamento</p>
                    </div>
                    <div class="row cont-crear">
                        <h5 class="title">Realice el levantamiento de inventario</h5>
                        <form id="form">
                            <div class="input-field col s12 m6">
                                <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                                <input type="password" name="clave" id="clave">
                                <label for="clave">Ingrese su clave de seguridad</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                            </div>
                            <div class="progress indigo darken-4" id="progress" style="display: none;">
                                <div class="indeterminate"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
} else
    echo "<h5 class='title'>No hay inventarios pendientes</h5>";
?>
<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>
<script>
    var array = Array()
    <?php while ($a = $inventario2->fetch_assoc()) {
    ?>
        array.push(<?php echo $a["id_bien"] ?>)
    <?php } ?>
    console.log(array)

    function marcado(id) {
        if (document.getElementById("existe" + id).checked)
            array.push(id)
        else {
            var pos = array.indexOf(id)
            array.splice(pos, 1)
        }
        console.log(array)
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
            url: 'levantar_inventario',
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