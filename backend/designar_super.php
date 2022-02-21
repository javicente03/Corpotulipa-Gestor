<?php
if (isset($router)) {
    $token = true;
    $password = trim(addslashes($_POST["password"]));

    include("bd.php");

    $administrador = ($bd->query("SELECT * FROM usuario WHERE id = " . $_SESSION["id"]))->fetch_assoc();

    if (password_verify($password, $administrador["password"])) {

        $user = ($bd->query("SELECT * FROM usuario WHERE id = " . $_POST["usuario_cargo"]))->fetch_assoc();

        if ($user) {

            if ($user["status"] == "active") {
                if ($user["permisos"] == "super")
                    $bd->query("UPDATE usuario SET permisos = 'basic' WHERE id = " . $_POST["usuario_cargo"]);
                else
                    $bd->query("UPDATE usuario SET permisos = 'super' WHERE id = " . $_POST["usuario_cargo"]);

                echo "ok";
            } else
                echo "Este usuario se encuentra suspendido";
        } else
            echo "Usuario no encontrado";
    } else
        echo "Debe ingresar su clave de seguridad";
} else
    header("Location: ../error.php");
