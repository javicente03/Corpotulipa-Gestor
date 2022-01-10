<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="container section">
    <div class="row">
        <h5 class="title">Solicitudes de caja chica relacionadas</h5>
        <table id="tabla" class="stripped responsive-table z-depth-3 centered">
            <thead class="table-head">
                <th>Fecha</th>
                <th>Solicitante</th>
                <th>Facturas</th>
                <th>Bs</th>
                <th>UT</th>
            </thead>
            <tbody>
                <?php
                while ($data = $solicitudes->fetch_assoc()) {
                    $bs += $data['bs'];
                    $ut += $data['ut_pedido'];
                ?>
                    <tr>
                        <td><?php echo $data['fecha'] ?></td>
                        <td><?php echo $data['nombre'] . " " . $data['apellido'] ?></td>
                        <td><button class="btn btn-flat" onclick="facturas(<?php echo $data['id_sol_cc'] ?>)">
                                <i class="material-icons left">collections</i>Facturas</button></td>
                        <td><?php echo $data['bs'] ?></td>
                        <td><?php echo $data['ut_pedido'] ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="indigo darken-4 white-text"><b>Totales:</b></td>
                    <td class="indigo darken-4 white-text"><b><?php echo $bs ?></b></td>
                    <td class="indigo darken-4 white-text"><b><?php echo $ut ?></b></td>
                </tr>
            </tbody>
        </table>
        <div style="display: flex;justify-content: center;">
            <div class="cont-caja-chica">
                <h4 class="title" style="text-align: center;">Fondo Actual de Caja Chica</h4>
                <h3 class="title" style="text-align: center;"><?php echo $cc['fondo_actual'] ?> <small>UT</small></h3>
            </div>
        </div>
        <div class="section" id="img-contenedor"><div id="imgs" class="row"></div></div>
        <div class="row">
            <div class="row col s12 m6"><button class="btn-opciones" id="btn-aprobar">Aprobar</button></div>
            <div class="row col s12 m6"><button class="btn-opciones" id="btn-rechazar">Rechazar</button></div>
        </div>
        <div class="row" id="aprobar" style="display: none;">
            <form id="form">
                <h5 class="title">Aprobar Solicitud</h5>
                <div class="input-field col s12 m6">
                    <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                    <input type="password" name="clave" id="clave">
                    <label for="clave">Ingrese su clave de seguridad</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="hidden" name="id" value="<?php echo $router->getParam() ?>">
                    <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                    <div class="progress indigo darken-4" id="progress" style="display: none;">
                        <div class="indeterminate"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row" id="rechazar" style="display: none;">
        <p class="parrafo"><i class="material-icons left">error</i>
            Por favor ingresa el cargo del solicitante de reposición 
                para la caja chica, se enviará a este una notificación expresando 
                el motivo del rechazo.</p>
            <form id="form2">
                <h5 class="title">Rechazar Solicitud</h5>
                <div class="input-field col s12 m6">
                    <i id="icon2" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                    <input type="password" name="clave" id="clave2">
                    <label for="clave2">Ingrese su clave de seguridad</label>
                </div>
                <div class="input-field col s12 m6">
                    <label for="motivo">Motivo del rechazo</label>
                    <textarea name="motivo" id="motivo" data-length="230" class="materialize-textarea"></textarea>
                    <span class="helper-text" data-error="El motivo del rechazo no puede exceder los 230 carácteres" data-success=""></span>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">widgets</i>
                    <select name="cargo" id="cargo">
                        <?php
                        while ($cargo = $cargos->fetch_assoc()) {
                            echo "<option value='" . $cargo['cargo_id'] . "'>" . $cargo['cargo'] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="cargo">Ingrese el cargo del solicitante</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="hidden" name="id" value="<?php echo $router->getParam() ?>">
                    <button type="submit" class="btn-entrar" id="btn-submit2">Enviar</button>
                    <div class="progress indigo darken-4" id="progress2" style="display: none;">
                        <div class="indeterminate"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script src="../frontend/js/notificaciones-page.js"></script>
<script src="../frontend/js/datatables.min.js"></script>

<script>
    $("#btn-aprobar").click(function(e) {
        $("#aprobar").css("display", 'block')
        $("#rechazar").css("display", 'none')
    })
    $("#btn-rechazar").click(function(e) {
        $("#aprobar").css("display", 'none')
        $("#rechazar").css("display", 'block')
    })

    function visualizar() {
        var pass = document.getElementById("clave");
        var icon = document.getElementById("icon");
        var pass2 = document.getElementById("clave2");
        var icon2 = document.getElementById("icon2");

        if (pass.getAttribute("type", "password") == "password") {
            pass.setAttribute("type", "text")
            icon.innerHTML = "visibility_off"
            pass2.setAttribute("type", "text")
            icon2.innerHTML = "visibility_off"
        } else {
            pass.setAttribute("type", "password")
            icon.innerHTML = "visibility"
            pass2.setAttribute("type", "password")
            icon2.innerHTML = "visibility"
        }
    }

    function facturas(id) {
        var cont = document.getElementById("img-contenedor"),
                imgs = document.getElementById("imgs");
            cont.removeChild(imgs)
            preloader = `<div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                        </div>
                    </div>`,
            nodo = document.createElement("div");
            nodo.innerHTML = preloader
            nodo.id="nodo"
            cont.appendChild(nodo)
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'recepcion_repo_cc',
                data: {id:id,factura:1},
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                        cont.removeChild(nodo)
                    var data = JSON.parse(response);
                        newImgs = document.createElement("div");
                    newImgs.className = "row cont-crear"
                    newImgs.id = "imgs"
                    newImgs.style = "overflow:scroll;height:400px"
                    h5 = document.createElement("h5")
                    h5Text = document.createTextNode("Facturas Relacionadas")
                    h5.className = "title"
                    h5.appendChild(h5Text)
                    newImgs.appendChild(h5)
                    data.forEach(e => {
                        var col = document.createElement("div"),
                            image = document.createElement("img");
                        col.className = "col s12 m6"
                        col.style = "margin:4px 0"
                        image.className = "materialboxed responsive-img"
                        image.src = "../"+e.factura
                        col.appendChild(image)
                        newImgs.appendChild(col)
                    });
                    cont.appendChild(newImgs)
                }
            });
    }

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        var formData = new FormData(document.getElementById("form"));
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'recepcion_repo_cc',
            data: formData,
            enctype: 'application/x-www-form-urlencoded',
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "../recepcion_repo_cc"
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

    $('#form2').submit(function(e) {
        $("#progress2").css("display", "block")
        $("#btn-submit2").prop('disabled', true)
        $("#btn-submit2").css('background', 'gray')
        var formData = new FormData(document.getElementById("form2"));
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'recepcion_repo_cc',
            data: formData,
            enctype: 'application/x-www-form-urlencoded',
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "../recepcion_repo_cc"
                } else {
                    M.toast({
                        html: response,
                        classes: 'rounded red'
                    })
                    $("#progress2").css("display", "none")
                    $("#btn-submit2").prop('disabled', false)
                    $("#btn-submit2").css('background', '#1a237e')
                }
            }
        });
    });
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>