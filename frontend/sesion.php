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
    <h1><?php
    echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] . " " . $_SESSION['email'];
    $ca1 = "javileon03";
    $ca2 = "ojavileon";
    $str = strpos($ca1, $ca2);
    $str2 = strpos($ca2, $ca1);
    echo $str;
    echo $str2;
    if ($str !== false || $str2 !== false)
        echo "si";
    else
        echo "No";

    ?></h1>
    </div>
</div>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>

<?php
include("frontend/modularizacion/cierre_html.php");
?>