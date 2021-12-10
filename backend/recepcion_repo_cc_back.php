<?php
if(isset($router)){
    $clave = trim(addslashes($_POST['clave']));

    if($clave != ""){
        include("bd.php");

        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            if($pass == "cuentadante")
                $ultima = $bd->query("UPDATE solicitud_repo_cc SET cuentadante = true WHERE id_solicitud_repo_cc = ".$_POST['id']);
            else if($pass == "coordinador")
                $ultima = $bd->query("UPDATE solicitud_repo_cc SET coordinador = true WHERE id_solicitud_repo_cc = ".$_POST['id']);
            else if($pass == "analista")
                $ultima = $bd->query("UPDATE solicitud_repo_cc SET analista = true WHERE id_solicitud_repo_cc = ".$_POST['id']);
            else if($pass == "contador")
                $ultima = $bd->query("UPDATE solicitud_repo_cc SET contador = true WHERE id_solicitud_repo_cc = ".$_POST['id']);
            else if($pass == "gerente")
                $ultima = $bd->query("UPDATE solicitud_repo_cc SET gerente = true WHERE id_solicitud_repo_cc = ".$_POST['id']);
            echo "ok";
        } else {
            echo "Dato incorrecto";
        }
    } else {
        echo "Debe ingresar su clave de usuario para confirmar";
    }
} else {
    header("Location: ../404");
}