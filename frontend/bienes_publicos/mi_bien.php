<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="row">
    <?php include("frontend/modularizacion/lateral_page.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <div class="row">
                <h5 class="title">
                    <a href="../mis_bienes" class="btn btn-flat" title="Regresar"><i class="material-icons">keyboard_return</i></a>
                    Ficha del bien público
                </h5>
                <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
                    <h6><b>Nombre: <?php echo $bien["nombre_bien"] ?></b></h6>
                </div>
                <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Código: <?php echo $bien["codigo"] ?></b></h6>
                </div>
                <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Código SUDEBIP: <?php echo $bien["catalogo"] ?></b></h6>
                </div>
                <div class="col s12 m2 blue lighten-3" style="border: 2px solid black;">
                    <h6><b><?php echo $bien["tipo"] ?></b></h6>
                </div>
                <div class="col s12 m8 blue lighten-3" style="border: 2px solid black;">
                    <h6><b>Departamento: <?php echo $_SESSION["departamento"] ?></b></h6>
                </div>
                <div class="col s12 m2 blue lighten-3" style="border: 2px solid black;">
                    <h6><b><?php echo $_SESSION["siglas"] ?></b></h6>
                </div>
                <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Organismo: <?php echo $bien["organismo"] ?></b></h6>
                </div>
                <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Dependencia: <?php echo $bien["dependencia"] ?></b></h6>
                </div>
                <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Fecha de Incorporación: <?php echo $bien["fecha_incorporacion"] ?></b></h6>
                </div>
                <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Valor: <?php echo $bien["valor"] ?> Bs</b></h6>
                </div>
                <?php
                if ($bien["tipo"] == "Mueble") {
                ?>
                    <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                        <h6><b>Descripción: <?php echo $bien["descripcion"] ?></b></h6>
                    </div>
                <?php
                } else {
                ?>
                    <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                        <h6><b>Número de Catastro: <?php echo $bien["catastro"] ?></b></h6>
                    </div>
                <?php
                }
                ?>

                <?php if ($prestado) {
                    if ($fecha > date('Y-m-d')) {
                        $hoy = date("Y-m-d");
                        $fecha_create = date_create($fecha);
                        $hoy_create = date_create($hoy);
                        $interval = date_diff($fecha_create, $hoy_create);
                        $restante = $interval->format('%a');
                ?>
                        <div class="col s12 blue lighten-3 center" style="border: 2px solid black;">
                            <h6><b>Prestado Actualmente</b></h6>
                        </div>
                        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                            <h6><b>Solicitante: <?php echo $prestado["nombre"] . " " . $prestado["apellido"] ?></b></h6>
                        </div>
                        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                            <h6><b>Departamento: <?php echo $prestado["departamento"] ?></b></h6>
                        </div>
                        <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                            <h6><b>Fecha prestamo: <?php echo $prestado["fecha_tramite"] ?></b></h6>
                        </div>
                        <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                            <h6><b>Fecha Fin: <?php echo $fecha ?></b></h6>
                        </div>
                        <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                            <h6><b>Restante: <?php echo $restante ?> Días</b></h6>
                        </div>
                <?php }
                } ?>
            </div>
            <?php
            if ($bien["tipo"] == "Mueble") { ?>
                <div class="row cont-crear">
                    <form id="form">
                        <h6 class="title">¡Ha ocurrido algún inconveniente?</h6>
                        <div class="input-field col s12 m6">
                            <div class="row">
                                <div class="col s12 m4">
                                    <p><label>
                                            <input type="radio" name="motivo" value="Robo" id="robo" class="with-gap">
                                            <span>Robo</span>
                                        </label></p>
                                </div>
                                <div class="col s12 m4">
                                    <p><label>
                                            <input type="radio" name="motivo" value="Hurto" id="hurto" class="with-gap">
                                            <span>Hurto</span>
                                        </label></p>
                                </div>
                                <div class="col s12 m4">
                                    <p><label>
                                            <input type="radio" name="motivo" value="Extravío" id="extravio" class="with-gap">
                                            <span>Extravío</span>
                                        </label></p>
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">edit</i>
                            <textarea name="descripcion" data-length="5000" class="materialize-textarea validate" id="descripcion" required></textarea>
                            <label for="descripcion">Exprese el motivo del reporte</label>
                            <span class="helper-text" data-error="Este dato es requerido y no debe exceder los 5000 caracteres" data-success=""></span>
                        </div>
                        <div class="input-field col s12 m6">
                            <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                            <input type="password" name="clave" id="clave">
                            <label for="clave">Ingrese su clave de seguridad</label>
                        </div>
                        <div class="col s12 m6 input-field">
                            <input type="hidden" name="bien" value="<?php echo $bien["id_bien"] ?>">
                            <button type="submit" class="btn-entrar" id="btn-submit">Reportar</button>
                            <div class="progress indigo darken-4" id="progress" style="display: none;">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>




<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script src="../frontend/js/notificaciones-page.js"></script>
<script>
    $(document).ready(function() {
        $('#descripcion').characterCounter();
    });

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
            url: 'mis_bienes',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "../mis_bienes";
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