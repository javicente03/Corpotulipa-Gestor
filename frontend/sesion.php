<?php
include("frontend/modularizacion/encabezado_html.php");
?>
<?php
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>
<div class="row">
    <?php include("frontend/modularizacion/lateral.php") ?>

    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <div class="row z-depth-3" style="padding: 10px;">
                <div class="col s12 m4">
                    <img src="<?php echo $_SESSION["img"] ?>" alt="Imágen del trabajador" class="responsive-img materialboxed">
                </div>
                <div class="col s12 m8">
                    <h5 class="title"><?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"] ?></h5>
                    <h6 class="title"><?php echo $_SESSION["departamento"]."-".$_SESSION["siglas"] ?></h6>
                    <h6 class="title">Cargo: <?php echo $_SESSION["cargo"] ?></h6>
                    <h6 class="title">Género: <?php echo $_SESSION["genero"] ?></h6>
                    <h6 class="title">Fecha de Nacimiento: <?php echo $_SESSION["birthday"] ?></h6>
                    <h6 class="title">Última conexión: <?php echo $_SESSION["ult_fecha"]." | ".$_SESSION["ult_hora"] ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>

<?php
include("frontend/modularizacion/cierre_html.php");
?>