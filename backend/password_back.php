<?php

if(isset($router)){
    $old = trim(addslashes($_POST['old']));
    $password = trim(addslashes($_POST['new']));
    $confirm = trim(addslashes($_POST['confirm']));

    if($old != "" && $password != "" && $confirm != ""){
        if(strcmp($password, $confirm) === 0){
            if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,12}$/', $password)) {
                reset_pass($old,$password,$router);
            } else {
                echo "La contraseña solo debe contener letras y números con una longitud de 12 caracteres";
            }
        } else {
            echo "Las contraseñas no coinciden";
        }
    } else {
        echo "Debe completar todos los campos correctamente";
    }
} else {
    header("Location: ../login");
}

function reset_pass($old,$password,$router){
    include("bd.php");
    $sql = "SELECT * FROM usuario INNER JOIN perfil ON usuario.id = perfil.id_usuario WHERE id = ".$_SESSION['id'];
    $proceso = $bd->query($sql);
    if($data = $proceso->fetch_assoc()){
        if(password_verify($old, $data['password'])){
            $pos1 = stripos($data['nombre'], $password);
            $pos2 = stripos($data['apellido'], $password);
            $pos3 = stripos($data['username'], $password);
            $pos4 = stripos($data['email'], $password);
            $pos5 = stripos($password, $data['nombre']);
            $pos6 = stripos($password, $data['apellido']);
            $pos7 = stripos($password, $data['username']);
            $pos8 = stripos($password, $data['email']);

            if($pos1 !== false || $pos2 !== false || $pos3 !== false || $pos4 !== false 
            || $pos5 !== false || $pos6 !== false || $pos7 !== false || $pos8 !== false)
                echo "Su contraseña no puede ser similar a sus datos de usuario";
            else{
                $opciones = [
                    'cost' => 12,
                ];
                $hash = password_hash($password, PASSWORD_BCRYPT, $opciones);
                $change = "UPDATE usuario SET password='$hash' WHERE id = ".$_SESSION['id'];
                $update = $bd->query($change);
                if($update)
                    echo "ok";
                else
                    echo "¡Oh no! ha ocurrido un error inesperado";
            }
        } else {
            echo "La contraseña actual no corresponde a su data";
        }
    }
}