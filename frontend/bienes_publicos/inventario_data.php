<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");

if ($inventario["aprobado"] && $inventario["fecha_fin_inventario"] == null) {

?>

    <div class="row">
        <?php include("frontend/modularizacion/lateral_page.php") ?>
        <div class="col m12 l9 contenido-principal">
            <div class="section">
                <div class="row">
                    <h5 class="title">
                        <a href="../inventario_data" class="btn btn-flat" title="Regresar"><i class="material-icons">keyboard_return</i></a>
                        Inventario
                    </h5>
                    <div class="col s12 m5 blue lighten-5" style="border: 2px solid black;">
                        <h6><b>Gerente: <?php echo $inventario["nombre"] . " " . $inventario["apellido"] ?></b></h6>
                    </div>
                    <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                        <h6><b><?php echo $inventario["departamento"] ?></b></h6>
                    </div>
                    <div class="col s12 m1 blue lighten-5" style="border: 2px solid black;">
                        <h6><b><?php echo $inventario["siglas"] ?></b></h6>
                    </div>
                    <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;height: 60px;">
                        <h6><b>Fecha de Toma: <?php echo $inventario["fecha_inventario_dep"] ?></b></h6>
                    </div>
                    <div class="col s12 m6 blue lighten-5 center" style="border: 2px solid black;height: 60px;">
                        <h6><b><a class="btn indigo darken-4 waves-effect waves-light" href="../inventario_data_pdf/<?php echo $id_data ?>" target="_blank"><i class="material-icons left">picture_as_pdf</i>Ver Reporte PDF</a></b></h6>
                    </div>

                    <div class="section">
                        <table id="tabla" class="striped responsive-table centered blue lighten-5">
                            <thead class="table-head">
                                <th>Nombre</th>
                                <th>Código del Catálogo</th>
                                <th>Identificación</th>
                                <th>Valor</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                while ($i = $data->fetch_assoc()) {
                                    $total += $i["valor"];
                                ?>
                                    <tr>
                                        <td><?php echo $i["nombre_bien"] ?></td>
                                        <td><?php echo $i["catalogo"] ?></td>
                                        <td><?php echo $i["codigo"] ?></td>
                                        <td><?php echo $i["valor"] ?></td>
                                        <td>
                                            <p><label>
                                                    <input class="filled-in" onchange="marcado(<?php echo $i['id_bien'] ?>)" type="checkbox" id="noexiste<?php echo $i["id_bien"] ?>">
                                                    <span></span></label></p>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="border: 2px solid black;" class="indigo darken-3 white-text"><b>Total:</b></td>
                                    <td style="border: 2px solid black;" class="indigo darken-3 white-text"><b><?php echo $total ?> Bs</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="parrafo"><i class="material-icons left">error</i>Por favor marque todos los bienes que no se encuentren fisicamente en el departamento</p>

                <div class="row cont-crear">
                    <h5 class="title">Verificar Inventario del Departamento</h5>
                    <form id="form">
                        <div class="col s12 m6 input-field">
                            <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                            <input type="password" name="clave" id="clave">
                            <label for="clave">Ingrese su clave de seguridad</label>
                        </div>
                        <div class="col s12 m6 input-field">
                            <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                            <div class="progress indigo darken-4" id="progress" style="display: none;">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                        <input type="hidden" name="inventario" value="<?php echo $id_data ?>">
                    </form>
                </div>
            </div>
        <?php
    } else
        echo "<h5 class='title'>El inventario relacionado a esta toma culminó</h5>";
        ?>
        </div>
    </div>

    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script src="../frontend/js/materialize.min.js"></script>
    <script src="../frontend/js/elementos-materialize.js"></script>
    <script src="../frontend/js/notificaciones-page.js"></script>
    <script>
        var array = Array()

        function marcado(id) {
            if (document.getElementById("noexiste" + id).checked)
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
                url: 'inventario_data',
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