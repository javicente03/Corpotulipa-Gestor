<?php
if(isset($router)){
        
    if(isset($_POST["cargar"]))
        CargarNotificaciones($router,$_POST["anterior"]);
    if(isset($_POST["no_leidas"]))
        NoLeidas($router);
    if(isset($_POST["marcar"]))
        MarcarLeida($router);
    
} else
    header("Location: ../404");


function CargarNotificaciones($router,$anterior){
    include("bd.php");
    $notificaciones = $bd->query("SELECT * FROM notificaciones 
        WHERE id_usuario = ".$_SESSION["id"]." 
        ORDER BY id_noti DESC LIMIT $anterior,10");

    $array = array();

    while ($row = $notificaciones->fetch_assoc()) {
        array_push($array, $row);
    }

    echo json_encode($array);
}

function NoLeidas($router){
    include("bd.php");
    $notificaciones = ($bd->query("SELECT * FROM notificaciones 
                        WHERE id_usuario = ".$_SESSION["id"]." 
                        AND leido=false"))->num_rows;
    echo $notificaciones;
}

function MarcarLeida($router){
    include("bd.php");
    if($bd->query("UPDATE notificaciones SET leido = true WHERE id_noti = ".$_POST["noti"]))
        echo "ok";
    else
        echo "err";
}