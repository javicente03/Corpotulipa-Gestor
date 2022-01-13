<?php
if (isset($router)) {
    if (isset($_POST["motivo"])) {
        $clave = trim(addslashes($_POST["clave"]));
        $motivo = trim(addslashes($_POST["motivo"]));
        $descripcion = trim(addslashes($_POST["descripcion"]));
        $id_bien = $_POST["bien"];

        if ($clave != "" && $motivo != "" && $descripcion != "") {
            if (strlen($descripcion) <= 5000) {
                include("bd.php");
                $usuario = ($bd->query("SELECT * FROM usuario WHERE id = " . $_SESSION['id']))->fetch_assoc();
                if (password_verify($clave, $usuario['password'])) {
                    $bien = ($bd->query("SELECT * FROM bienes_publicos WHERE id_bien = $id_bien AND responsable = " . $_SESSION["id"]))->fetch_assoc();
                    if ($bien) {
                        $reporte = $bd->query("INSERT INTO reporte_bien (id_bien,motivo_reporte,descripcion_reporte) 
                    VALUES ('$id_bien','$motivo','$descripcion')");
                        echo "ok";
                    } else
                        echo "Este elemento no está a su cargo";
                } else
                    echo "Clave inválida";
            } else
                echo "La descripción del reporte no debe exceder los 5000 carácteres";
        } else {
            echo "Debe ingresar todos los datos correspondientes";
        }
    } else
        echo "Seleccione un motivo";
} else
    header("Location: ../404");
