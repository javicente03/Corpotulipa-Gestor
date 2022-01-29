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
                    <a href="../bienes_faltantes" class="btn btn-flat" title="Regresar"><i class="material-icons">keyboard_return</i></a>
                    Reporte de robo, hurto o extravío
                </h5>

                <div class="col s12 m5 blue lighten-3 center" style="border: 2px solid black;">
                    <h6><b>Nombre: <?php echo $bien["nombre_bien"] ?></b></h6>
                </div>
                <div class="col s12 m4 blue lighten-3" style="border: 2px solid black;">
                    <h6><b>Fecha de incorporación: <?php echo $bien["fecha_incorporacion"] ?></b></h6>
                </div>
                <div class="col s12 m3 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $bien["motivo_reporte"] ?></b></h6>
                </div>
                <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Descripción: <?php echo $bien["descripcion"] ?></b></h6>
                </div>
                <div class="col s12 blue lighten-3 center" style="border: 2px solid black;">
                    <h6><b>Responsable</b></h6>
                </div>
                <div class="col s12 m5 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $bien["nombre"] . " " . $bien["apellido"] ?></b></h6>
                </div>
                <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $bien["departamento"] ?></b></h6>
                </div>
                <div class="col s12 m1 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $bien["siglas"] ?></b></h6>
                </div>
                <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Reporte Extendido: <?php echo $bien["descripcion_reporte"] ?></b></h6>
                </div>
            </div>
            <div class="row cont-crear">
                <h5 class="title">Tramitar Reporte</h5>
                <form id="form" action="../bienes_faltantes" method="POST" enctype="application/x-www-form-urlencoded">
                    <div class="col s12 m6 input-field">
                        <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                        <input type="password" name="clave" id="clave">
                        <label for="clave">Ingrese su clave de seguridad</label>
                    </div>
                    <div class="col s12 m6 input-field">
                        <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                    </div>
                    <input type="hidden" name="reporte" value="<?php echo $bien["id_reporte_bien"] ?>">
                </form>
            </div>
        </div>
    </div>
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
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>