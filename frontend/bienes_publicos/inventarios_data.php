<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");
?>
<div class="row">
        <?php include("frontend/modularizacion/lateral.php") ?>
        <div class="col m12 l9 contenido-principal">
<?php
if (isset($inventarios)) {
?>

    
            <div class="section">
                <div class="row">
                    <h5 class="title">Inventario</h5>
                    <table id="tabla" class="striped responsive-table centered blue lighten-5">
                        <thead class="table-head">
                            <th>Departamento</th>
                            <th>Sede</th>
                            <th>Fecha de Toma</th>
                            <th>Verificado</th>
                            <th>Revisar</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($i = $inventarios->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $i["siglas"] ?></td>
                                    <td><?php echo $i["sede"] ?></td>
                                    <td><?php echo $i["fecha_inventario_dep"] ?></td>
                                    <td><?php if($i["verificado"]){echo "Si";}else{echo "No";} ?></td>
                                    <td><a class="btn btn-flat" href="inventario_data/<?php echo $i["id_inventario_departamento"] ?>">
                                            <i class="material-icons">visibility</i></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="row cont-crear">
                    <form id="form">
                        <h5 class="title">Finalizar Inventario</h5>
                        <div class="col s12 m6 input-field">
                            <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                            <input type="text" id="clave" name="clave">
                            <label for="clave">Ingrese su clave de seguridad</label>
                        </div>
                        <div class="col s12 m6 input-field">
                            <input type="hidden" name="motive" value="closed">
                            <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                            <div class="progress indigo darken-4" id="progress" style="display: none;">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        <?php
    } else
        echo "<h5 class='title'>No hay inventarios pendientes</h5>";
        ?>
        </div>
    </div>

    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script src="frontend/js/materialize.min.js"></script>
    <script src="frontend/js/elementos-materialize.js"></script>
    <script src="frontend/js/notificaciones.js"></script>

    <script>
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
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'inventario_data',
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
    </script>
    <?php
    include("frontend/modularizacion/cierre_html.php");
    ?>