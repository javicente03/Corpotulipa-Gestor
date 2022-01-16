<?php
if (isset($router)) {
    $prestamo = trim(addslashes($_POST["prestamo"]));
    $solicitante = trim(addslashes($_POST["solicitante"]));
    $date = date("Y-m-d");
    $nombre_bien = trim(addslashes($_POST["nombre_bien"]));

    if (isset($_POST["accion"])) {
        $accion = $_POST["accion"];
        if ($accion == "aprobar") {
            include("bd.php");
            $texto = $_SESSION["nombre"] . " " . $_SESSION["apellido"] . " ha aceptado tu solicitud de prestamo del bien público $nombre_bien";
            $aprobar = $bd->query("UPDATE prestamo_bien SET aprobado = true WHERE id_prestamo_bien = $prestamo");
            $notificacion = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha) VALUES ('$solicitante','$texto','$date')");
            echo "ok";
        } else {
            $motivo = trim(addslashes($_POST["motivo"]));
            if (strlen($motivo) <= 250) {
                include("bd.php");
                $texto = $_SESSION["nombre"] . " " . $_SESSION["apellido"] . " ha rechazado tu solicitud de prestamo del bien público $nombre_bien, motivo: " . $motivo;
                $rechazar = $bd->query("UPDATE prestamo_bien SET rechazado = true WHERE id_prestamo_bien = $prestamo");
                $notificacion = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha) VALUES ('$solicitante','$texto','$date')");
                echo "ok";
            } else
                echo "Este dato es obligatorio y no debe exceder los 250 caracteres";
        }
    } else
        echo "Debe seleccionar una opción";
} else
    header("Location: ../404");
