<?php
if(isset($router)){
    $anterior = isset($_POST["anterior"])? $_POST['anterior'] : 1;
    include("bd.php");
    $notificaciones = ($bd->query("SELECT * FROM notificaciones 
                        WHERE id_usuario = ".$_SESSION["id"]." 
                        AND leido=false"))->num_rows;
    echo $notificaciones;
} else
    header("Location: ../404");