<?php
if(isset($router)){
    $nombre = trim(addslashes($_POST['nombre']));
    $apellido = trim(addslashes($_POST['apellido']));
    $email = trim(addslashes($_POST['email']));
    $nacimiento = trim(addslashes($_POST['nacimiento']));
    if(isset($_POST['genero']))
        $genero = trim(addslashes($_POST['genero']));
    else
        $genero="";
    
    if($nombre != "" && $apellido != "" && $email != "" 
        && $genero != "" && $nacimiento != ""){
            include("validaciones.php");
            $email_valido = validar_email($email);
            if($email_valido){
                $fecha_valida = validar_fecha($nacimiento);
                if($fecha_valida){
                    $hoy = date('d-m-y');
                    $formato_nacimiento = date('d-m-y', strtotime($nacimiento));
                    $diff = calcular_fecha($hoy,$formato_nacimiento);
                    if($diff->y >= 18){
                        if($genero == "Masculino" || $genero == "Femenino" || $genero == "Otro"){
                            if($genero == "Otro"){
                                $other = trim(addslashes($_POST['other']));
                                if($other != ""){
                                    $genero = $other;
                                    editarUser($nombre,$apellido,$email,$genero,$nacimiento,$router);
                                } else {
                                    echo "Debe ingresar un género";
                                }
                            } else {
                                editarUser($nombre,$apellido,$email,$genero,$nacimiento,$router);
                            }
                        } else {
                            echo "Género no válido";
                        }
                    } else {
                        echo "La fecha indicada correponde a un menor de edad";
                    }
                } else {
                    echo "Ingrese una fecha válida";
                }
            } else {
                echo "Ingrese un correo Gmail valido";
            }
    } else {
        echo "Debe completar todos los datos correctamente";
    }
} else {
    header("Location: ../404");
}

function editarUser($nombre,$apellido,$email,$genero,$nacimiento,$router){
    include("bd.php");

    if(empty($_FILES['img']['tmp_name']))
        $thumb = $_SESSION['img'];
    else{
        include("imagenes/ajuste_img.php");
        $tipo = $_FILES["img"]["type"];
        $archivo = $_FILES["img"]["tmp_name"];
        $upload = subir_imagen($tipo,$archivo,$_SESSION['username']);
        if($upload)
            $thumb = "frontend/img/profile/".$_SESSION['username'].$upload;
        else
            $thumb = "fail";
    }

    if($thumb != "fail"){
        $_SESSION['img'] = $thumb;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['email'] = $email;
        $_SESSION['genero'] = $genero;
        $_SESSION['birthday'] = $nacimiento;

        $sql = "SELECT * FROM usuario WHERE email = '".$email."' AND id != ".$_SESSION['id'];
        $proceso = $bd->query($sql);
        if($proceso->num_rows <= 0){
            $editar = "UPDATE usuario SET email='$email' WHERE id = ".$_SESSION['id'];
            $edicion = $bd->query($editar);
            if($edicion){
                $editar1 = "UPDATE perfil SET nombre='$nombre',apellido='$apellido',genero='$genero',fecha_nacimiento='$nacimiento',img='$thumb' WHERE id_usuario = ".$_SESSION['id'];
                $edicion1 = $bd->query($editar1);
                if($edicion1){
                    echo "ok";
                } else {
                    echo "¡Oh no! Ocurrió un error inesperado";
                }
            } else {
                echo "¡Oh no! Ocurrió un error inesperado";
            }
        } else {
            echo "Correo electrónico en uso";
        }
    } else 
        echo "Archivo inválido, debe subir una imágen JPEG, PNG o GIF";
}
    