<?php
if(isset($router)){
    $bien = trim(addslashes($_POST["bien"]));
    $duracion = trim(addslashes($_POST["duracion"]));
    $motivo = trim(addslashes($_POST["motivo"]));
    $nombre_bien = trim(addslashes($_POST["nombre_bien"]));
    $responsable = trim(addslashes($_POST["responsable"]));
    $usuario_id = $_SESSION["id"];

    if($bien!="" && $motivo!="" && $duracion!=""){
        if(is_numeric($duracion)){
        $date = date("Y-m-d");
        if(!isset($_POST["externo"]))
            $texto = $_SESSION["nombre"]." ".$_SESSION["apellido"]." ha solicitado un prestamo del bien público a su responsabilidad: $nombre_bien.";
        else
            $texto = $_SESSION["nombre"]." ".$_SESSION["apellido"]." ha reportado la solicitud de un prestamo del bien público: $nombre_bien. Por favor indique si esta procederá.";

            include("bd.php");
            $solicitud = $bd->query("INSERT INTO prestamo_bien (id_bien,solicitante,fecha_prestamo,duracion,motivo) VALUES ('$bien','$usuario_id','$date','$duracion','$motivo')");
            $solicitudes = ($bd->query("SELECT * FROM prestamo_bien ORDER BY id_prestamo_bien DESC"))->fetch_assoc();
            $link = "revisar_prestamo_bien/".$solicitudes['id_prestamo_bien'];
            $notificacion = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) VALUES ('$responsable','$texto','$date','$link')");
            echo "ok";
        } else
            echo "La duración del prestamo debe ser numérica";
    } else {
        echo "Debe completar todos los datos requeridos";
    }
} else 
    header("Location: ../404");