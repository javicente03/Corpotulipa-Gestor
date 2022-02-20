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
    
    </div>
</div>


<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>

<?php
include("frontend/modularizacion/cierre_html.php");
?>