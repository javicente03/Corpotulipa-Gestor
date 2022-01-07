<?php
if(isset($router)){
    $anterior = isset($_POST["anterior"])? $_POST['anterior'] : 1;
    include("bd.php");
    $notificaciones = $bd->query("SELECT * FROM notificaciones 
                        WHERE id_usuario = ".$_SESSION["id"]." 
                        ORDER BY id_noti DESC LIMIT $anterior,10");

    $array = array();

    while ($row = $notificaciones->fetch_assoc()) {
        array_push($array, $row);
    }

    echo json_encode($array);
} else
    header("Location: ../404");