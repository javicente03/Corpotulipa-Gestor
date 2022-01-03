<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            if(isset($_POST["respuesta"])){
                $hoy = date("Y-m-d");
                $observaciones = trim(addslashes($_POST["observaciones"]));
                $adiestramiento = ($bd->query("SELECT * FROM adiestramiento WHERE id_adiestramiento = ".$_POST["solicitud"]))->fetch_assoc();
                if($_POST["respuesta"] == "Si"){
                    $bd->query("UPDATE adiestramiento SET aprobado=true,observaciones='$observaciones'
                            WHERE id_adiestramiento = ".$_POST["solicitud"]);
                    $participantes = $bd->query("SELECT * FROM participante_adiestramiento 
                                    WHERE id_adiestramiento = ".$_POST["solicitud"]);
                    $texto = "Has sido invitado a un adiestramiento el día ".$adiestramiento["fecha_adiestramiento"].", pulsa para obtener más información";
                    $link = "ver_adiestramiento/".$adiestramiento["id_adiestramiento"];
                    while($p = $participantes->fetch_assoc()){
                        $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) 
                        VALUES ('".$p["participante"]."','$texto','$hoy','$link')");
                    }
                } else{
                    $texto = "Tu solicitud de adiestramiento al personal ha sido rechazada. Motivo: ".$observaciones;
                    $bd->query("DELETE FROM adiestramiento WHERE id_adiestramiento = ".$_POST["solicitud"]);
                    $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha) 
                    VALUES ('".$adiestramiento["solicitante"]."','$texto','$hoy')");
                }
                echo "ok";
            } else
                echo "Debe indicar una respuesta";
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar su clave de seguridad";
} else
    header("Location: ../404");