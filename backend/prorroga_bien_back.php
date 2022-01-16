<?php
if (isset($router)) {
    $tramite = $_POST["tramite"];
    $motivo = trim(addslashes($_POST["motivo"]));
    $duracion = trim(addslashes($_POST["duracion"]));
    $clave = trim(addslashes($_POST["clave"]));
    $id_bien = $_POST["id_bien"];
    $nombre_bien = $_POST["nombre_bien"];
    $codigo = $_POST["codigo"];
    $responsable = $_POST["responsable"];
    $id_user = $_SESSION["id"];
    $date = date("Y-m-d");
    $texto = $_SESSION["nombre"] . " " . $_SESSION["apellido"] . " ha solicitado una prorroga para el prestamo del bien público a su responsabilidad: $nombre_bien ($codigo), por favor indique si dicha solicitud procederá.";

    if ($clave != "") {
        if ($motivo != "" && $duracion != "") {
            if (is_numeric($duracion)) {
                if (strlen($motivo) <= 2000) {
                    include("bd.php");
                    $usuario = ($bd->query("SELECT * FROM usuario WHERE id = " . $_SESSION['id']))->fetch_assoc();
                    if (password_verify($clave, $usuario['password'])) {
                        $bd->query("INSERT INTO `prestamo_bien`(`id_bien`, `solicitante`, `fecha_prestamo`, `duracion`, `motivo`) VALUES ('$id_bien','$id_user','$date','$duracion','$motivo')");
                        $solicitudes = ($bd->query("SELECT * FROM prestamo_bien ORDER BY id_prestamo_bien DESC"))->fetch_assoc();
                        $link = "revisar_prestamo_bien/" . $solicitudes['id_prestamo_bien'];
                        $notificacion = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) VALUES ('$responsable','$texto','$date','$link')");
                        echo "ok";
                    } else
                        echo "Clave Inválida";
                } else
                    echo "El motivo no debe exceder los 2000 caracteres";
            } else
                echo "La duración del prestamo debe ser numérica";
        } else
            echo "Debe completar todos los datos requeridos";
    } else
        echo "Debe ingresar su clave de usuario para confirmar";
} else
    header("Location: ../404");
