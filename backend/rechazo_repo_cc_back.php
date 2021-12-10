<?php
if(isset($router)){
    $clave = trim(addslashes($_POST['clave']));
    $motivo = trim(addslashes($_POST['motivo']));
    $cargo = trim(addslashes($_POST['cargo']));
    $id = trim(addslashes($_POST['id']));
    $texto = "Rechazo de solicitud de reposición de caja chica #".$id.": ".$motivo;
    $fecha = date("Y-m-d");
    if($clave != "" && $cargo != "" && $motivo != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $usuarios = $bd->query("SELECT * FROM perfil p INNER JOIN usuario u ON p.id_usuario = u.id WHERE cargo_id =$cargo");
            while ($user = $usuarios->fetch_assoc()) {
                $id_user = $user['id'];
                $noti =  $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha) VALUES ('$id_user','$texto','$fecha')");
            }
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