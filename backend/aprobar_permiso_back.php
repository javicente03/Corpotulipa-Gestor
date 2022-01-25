<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            if(isset($_POST["respuesta"])){
                $hoy = date('Y-m-d');
                $respuesta = $_POST["respuesta"];
                $observacion = $_POST["observacion"];
                $id = $_POST["permiso"];
                $permiso = ($bd->query("SELECT * FROM solicitud_permiso WHERE id_solicitud_permiso = $id"))->fetch_assoc();
                if($permiso){                
                    if($respuesta == "Aprobar"){
                        if(isset($_POST["remuneracion"])){
                            $remuneracion = $_POST["remuneracion"]=="si" ? true : false;
                            $bd->query("UPDATE solicitud_permiso SET aprobado=true,fecha_respuesta='$hoy',
                                        remunerado='$remuneracion',observacion='$observacion'
                                        WHERE id_solicitud_permiso = $id");
                            if($remuneracion)
                                $texto = "Ha sido aprobado tu solicitud de permiso laboral del día ".$permiso["fecha_solicitud"].". Observación: ".$observacion.". Remunerado";
                            else
                                $texto = "Ha sido aprobado tu solicitud de permiso laboral del día ".$permiso["fecha_solicitud"].". Observación: ".$observacion.". No Remunerado";
                            $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha)
                                        VALUES ('".$permiso["id_usuario"]."','$texto','$hoy')");
                            echo "ok";
                        } else
                            echo "Debe completar todos los datos solicitados";
                    } else {
                        $bd->query("UPDATE solicitud_permiso SET aprobado=false,fecha_respuesta='$hoy',
                                    observacion='$observacion'
                                    WHERE id_solicitud_permiso = $id");
                        $texto = "Ha sido rechazada tu solicitud de permiso laboral del día ".$permiso["fecha_solicitud"].". ".$observacion;
                        $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha)
                                    VALUES ('".$permiso["id_usuario"]."','$texto','$hoy')");
                        echo "ok";
                    }
                } else
                    echo "No existe esta solicitud";
            } else
                echo "Debe completar todos los datos solicitados";
        } else
            echo "Clave inválida";
    } else
        echo "Ingrese su clave de seguridad";
} else
    header("Location: ../404");