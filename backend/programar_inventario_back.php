<?php
if (isset($router)) {
    $clave = trim(addslashes($_POST["clave"]));
    $motivo = trim(addslashes($_POST["motivo"]));
    $user = $_SESSION["id"];

    if ($clave != "" && $motivo != "") {
        if (strlen($motivo) <= 5000) {
            include("bd.php");
            $usuario = ($bd->query("SELECT * FROM usuario WHERE id = " . $_SESSION['id']))->fetch_assoc();
            if (password_verify($clave, $usuario['password'])) {
                $date = date("Y-m-d");
                $programar = $bd->query("INSERT INTO inventario (motivo,fecha_inventario,solicitante) 
                                    VALUES ('$motivo','$date','$user')");
                echo "ok";
            } else
                echo "Clave inválida";
        } else
            echo "El motivo no debe exceder los 5000 caracteres";
    } else
        echo "Debe completar todos los datos";
} else
    header("Location: ../404");
