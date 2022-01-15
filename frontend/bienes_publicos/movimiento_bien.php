<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="container section">
    <div class="row">
        <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
            <h6><b>Nombre: <?php echo $responsable["nombre_bien"] ?></b></h6>
        </div>
        <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
            <h6><b>Responsable</b></h6>
        </div>
        <div class="col s12 m5 blue lighten-5" style="border: 2px solid black;">
            <h6><b><?php echo $responsable["nombre"] . " " . $responsable["apellido"] ?></b></h6>
        </div>
        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
            <h6><b><?php echo $responsable["departamento"] ?></b></h6>
        </div>
        <div class="col s12 m1 blue lighten-5" style="border: 2px solid black;">
            <h6><b><?php echo $responsable["siglas"] ?></b></h6>
        </div>
        <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
            <h6><b>Solicitante</b></h6>
        </div>
        <div class="col s12 m5 blue lighten-5" style="border: 2px solid black;">
            <h6><b><?php echo $prestamo["nombre"] . " " . $prestamo["apellido"] ?></b></h6>
        </div>
        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
            <h6><b><?php echo $prestamo["departamento"] ?></b></h6>
        </div>
        <div class="col s12 m1 blue lighten-5" style="border: 2px solid black;">
            <h6><b><?php echo $prestamo["siglas"] ?></b></h6>
        </div>
        <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
            <h6><b>Fecha de la solicitud: <?php echo $prestamo["fecha_prestamo"] ?></b></h6>
        </div>
        <div class="col s12 m4  blue lighten-5" style="border: 2px solid black;">
            <h6><b>Duración: <?php echo $prestamo["duracion"] ?> Días</b></h6>
        </div>
        <div class="col s12 m4  blue lighten-5" style="border: 2px solid black;">
            <h6><b>Fecha final: <?php echo $prestamo["DATE_ADD(fecha_prestamo, INTERVAL duracion DAY)"] ?></b></h6>
        </div>
        <div class="col s12  blue lighten-5" style="border: 2px solid black;">
            <h6><b>Motivo: <?php echo $prestamo["motivo"] ?></b></h6>
        </div>
    </div>
    <div class="row cont-crear">
        <form id="form">
            <input type="hidden" name="analista" value="a">
            <input type="hidden" name="prestamo" value="<?php echo $prestamo["id_prestamo_bien"] ?>">
            <input type="hidden" name="nombre_bien" value="<?php echo $responsable["nombre_bien"] ?>">
            <input type="hidden" name="bien" value="<?php echo $responsable["id_bien"] ?>">
            <input type="hidden" name="solicitante" value="<?php echo $prestamo["solicitante"] ?>">
            <input type="hidden" name="solicitante_nombre" value="<?php echo $prestamo["nombre"] . " " . $prestamo["apellido"] ?>">
            <input type="hidden" name="responsable" value="<?php echo $responsable["responsable"] ?>">
            <input type="hidden" name="responsable_nombre" value="<?php echo $responsable["nombre"] . " " . $responsable["apellido"] ?>">

            <div class="input-field col s12 m6">
                <div class="row">
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="tipo" id="interno" value="Interno">
                                <span>Interno</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="tipo" id="externo" value="Externo">
                                <span>Externo</span>
                            </label></p>
                    </div>
                </div>
            </div>
            <div class="input-field col s12 m6">
                <div class="row">
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="concepto" id="Prestamo" value="Prestamo">
                                <span>Préstamo</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="concepto" id="Traslado" value="Traslado">
                                <span>Traslado</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="concepto" id="Mantenimiento" value="Mantenimiento">
                                <span>Mantenimiento</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="concepto" id="Garantia" value="Garantia">
                                <span>Garantía</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="concepto" id="Reparacion" value="Reparacion">
                                <span>Reparación</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="concepto" id="Cambio" value="Cambio">
                                <span>Cambio</span>
                            </label></p>
                    </div>
                </div>
            </div>
            <div class="input-field col s12 m6">
                <select name="coordinador" id="coordinador">
                    <?php
                    while ($usuario = $usuarios->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $usuario["id"] ?>"><?php echo $usuario["nombre"] . " " . $usuario["apellido"] . " | " . $usuario["cargo"] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="coordinador">Coordinador</label>
            </div>
            <div class="input-field col s12 m6">
                <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                <input type="password" name="clave" id="clave">
                <label for="clave">Ingrese su clave de seguridad</label>
            </div>

            <!-- DATOS DE PERSONA JURIDICA EN CASO DE SER EXTERNO -->
            <div id="juridico" style="display: none;">
                <div class="input-field col s12 m6">
                    <input type="text" name="razon" id="razon">
                    <label for="razon">Razón Social</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="rif" id="rif">
                    <label for="rif">Rif</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="direccion" id="direccion">
                    <label for="direccion">Dirección Fiscal</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="nombre_responsable" id="nombre_responsable">
                    <label for="nombre_responsable">Nombre del Responsable</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="telefono_fijo" id="telefono_fijo">
                    <label for="telefono_fijo">Teléfono Fijo</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="telefono_contacto" id="telefono_contacto">
                    <label for="telefono_contacto">Mobil</label>
                </div>
            </div>
            <div class="input-field col s12">
                <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </form>
    </div>
    <p class="parrafo"><i class="material-icons left">error</i>
        En caso de que la petición sea de alguien externo a la corporación, 
        por favor llene los datos de la persona jurídica</p>
</div>



<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script src="../frontend/js/notificaciones-page.js"></script>
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

    $("#interno").click(function(e) {
        $("#juridico").css("display", "none")
    })

    $("#externo").click(function(e) {
        $("#juridico").css("display", "block")
    })

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'movimiento_bienes',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "../movimiento_bienes";
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