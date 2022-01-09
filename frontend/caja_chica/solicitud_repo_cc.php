<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");
?>

<div class="container section">
    <table class="stripped responsive-table z-depth-3 centered">
        <thead class="table-head">
            <th>Solicitante</th>
            <th>Unidad</th>
            <th>Fecha</th>
            <th>Bs</th>
            <th>UT</th>
        </thead>
        <tbody>
            <?php
            while ($data = $solicitudes->fetch_assoc()) {
                $totalBs += $data['bs'];
                $totalUT += $data['ut_pedido'];
            ?>
                <tr>
                    <td><?php echo $data['nombre'] . " " . $data['apellido'] ?></td>
                    <td><?php echo $data['departamento'] ?></td>
                    <td><?php echo $data['fecha'] ?></td>
                    <td><?php echo $data['bs'] ?></td>
                    <td><?php echo $data['ut_pedido'] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td></td>
                <td></td>
                <td class="indigo darken-4 white-text"><b>Total:</b></td>
                <td class="indigo darken-4 white-text"><b><?php echo $totalBs ?></b></td>
                <td class="indigo darken-4 white-text"><b><?php echo $totalUT ?></b></td>
            </tr>
        </tbody>
    </table>
    <div style="display: flex;justify-content: center;">
        <div class="cont-caja-chica">
            <h4 class="title" style="text-align: center;">Fondo Actual de Caja Chica</h4>
            <h3 class="title" style="text-align: center;"><?php echo $cc['fondo_actual'] ?> <small>UT</small></h3>
        </div>
    </div>
    <p style="text-align: center; background-color: gray; padding: 10px;border-radius: 1em;font-weight: bold;color:black;margin:10px 0;">
        <i class="material-icons left">error</i>
        Aquí estarán cargadas todas las solicitudes de caja chica que hayan sido validadas con su(s) factura(s) a partir
        de la última reposición realizada.
    </p>

    <div class="row cont-crear">
        <form id="form">
            <h5 class="title">Solicitar Reposición de Caja Chica</h5>
            <div class="col s12 m6 input-field">
                <i class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                <input type="password" name="clave" id="clave">
                <label for="clave">Ingrese su clave de seguridad</label>
            </div>
            <div class="col s12 m6 input-field">
                <input type="hidden" name="monto" value="<?php echo $cc['fondo_actual'] ?>">
                <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>
<script src="frontend/js/datatables.min.js"></script>

<script>
    function visualizar() {
        var pass = document.getElementById("clave");
        var icon = document.getElementById("icon-password");

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
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'solicitud_repo_cc',
            data: formData,
            enctype: 'application/x-www-form-urlencoded',
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
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
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>