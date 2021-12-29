<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $descripcion = trim(addslashes($_POST["descripcion"]));
            $inicio = $_POST["inicio"];
            $fin = $_POST["fin"];
            $responsable = $_POST["responsable"];
            if(isset($_POST["motivo"]) && $descripcion !=""){
                include("validaciones.php");
                $motivo = $_POST["motivo"];
                $fecha_valida1 = validar_fecha($inicio);
                $fecha_valida2 = validar_fecha($fin);
                $hoy = date('Y-m-d');
                if($fecha_valida1 && $fecha_valida2 && $inicio >= $hoy && $fin >= $hoy && $inicio <= $fin){
                    $user = $_SESSION["id"];
                    $bd->query("INSERT INTO solicitud_permiso (id_usuario,fecha_solicitud,hora_solicitud,
                    fecha_inicio,fecha_fin,motivo,descripcion,responsable) 
                    VALUES ('$user','$hoy','$inicio','$fin','$motivo','$descripcion','$responsable')");
                    $ultimo = ($bd->query("SELECT * FROM solicitud_permiso 
                                ORDER BY id_solicitud_permiso DESC LIMIT 1"))->fetch_assoc();
                    $link = "solicitud_permiso/".$ultimo["id_solicitud_permiso"];
                    $texto = $_SESSION["nombre"]." ".$_SESSION["apellido"]." ha solicitado un permiso, por favor indique su respuesta";
                    $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link)
                                VALUES ('$value','$texto','$hoy','$link')");
                    echo "ok";
                } else
                    echo "Error en las fechas escogidas";
            } else
                echo "Debe completar todos los datos";
        } else
            echo "Clave inválida";
    } else
        echo "Ingrese su clave de seguridad";
} else
    header("Location: ../404");