<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    $incorporacion = trim(addslashes($_POST["incorporacion"]));

    if($clave !=""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $data = ($bd->query("SELECT * FROM verificacion_bienes WHERE id_bien = $incorporacion"))->fetch_assoc();
            if($data){
                if($_SESSION["id"] == $data["user1"])
                    $bd->query("UPDATE verificacion_bienes SET revisado = true WHERE id_bien = $incorporacion");
                if($_SESSION["id"] == $data["user2"])
                    $bd->query("UPDATE verificacion_bienes SET verificado = true WHERE id_bien = $incorporacion");
                if($_SESSION["id"] == $data["user3"])
                    $bd->query("UPDATE verificacion_bienes SET validado = true WHERE id_bien = $incorporacion");
                echo "ok";
            } else 
                echo "Incorporación inválida";
        } else {
            echo "Clave de seguridad inválida";
        }
    } else
        echo "Debe ingresar la clave";
} else {
    header("Location: ../404");
}