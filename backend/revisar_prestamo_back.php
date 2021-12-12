<?php
if(isset($router)){
    $prestamo = trim(addslashes($_POST["prestamo"]));
    $solicitante = trim(addslashes($_POST["solicitante"]));
    $accion = $_POST["accion"];
    $motivo = trim(addslashes($_POST["motivo"]));
    $date = date("Y-m-d");
    $nombre_bien = trim(addslashes($_POST["nombre_bien"]));

    if($accion =="aprobar"){
        include("bd.php");
        $aprobar = $bd->query("UPDATE prestamo_bien SET aprobado = true WHERE id_prestamo_bien = $prestamo");
        echo "ok";
    } else {
        include("bd.php");
        $texto = $_SESSION["nombre"]." ".$_SESSION["apellido"]." ha rechazado tu solicitud de prestamo del bien público $nombre_bien, motivo: ".$motivo;
        $rechazar = $bd->query("UPDATE prestamo_bien SET rechazado = true WHERE id_prestamo_bien = $prestamo");
        $notificacion = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha) VALUES ('$solicitante','$texto','$date')");
        echo "ok";
    }
} else
    header("Location: ../404");