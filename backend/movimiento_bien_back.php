<?php
if(isset($router)){
    $solicitante = $_POST["solicitante"];
    $responsable = $_POST["responsable"];
    $coordinador = $_POST["coordinador"];
    $prestamo = $_POST["prestamo"];
    $nombre_bien = $_POST["nombre_bien"];
    $bien = $_POST["bien"];
    $clave = trim(addslashes($_POST["clave"]));
    $texto = "Se ha iniciado el tramite de un bien público: $nombre_bien, por favor indique su confirmación";
    $link = "movimiento_bienes/$prestamo";
    $usuario_id = $_SESSION["id"];
    $date = date("Y-m-d");

    if(isset($_POST["tipo"]) && isset($_POST["concepto"])){
    $tipo = $_POST["tipo"];
    $concepto = $_POST["concepto"];

    if($clave != ""){
        include("bd.php");

        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $tramite = $bd->query("INSERT INTO tramite_bienes (id_prestamo_bien,tipo,concepto,user1,user2,user3,user4,fecha_tramite) 
                                    VALUES ('$prestamo','$tipo','$concepto','$usuario_id','$coordinador','$responsable','$solicitante','$date')");

            $tramitado = $bd->query("UPDATE prestamo_bien SET tramitado = true WHERE id_prestamo_bien = $prestamo");
            $noti1 = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) 
                                    VALUES ('$coordinador','$texto','$date','$link')");
            $noti2 = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) 
                                    VALUES ('$responsable','$texto','$date','$link')");
            $noti3 = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) 
                                    VALUES ('$solicitante','$texto','$date','$link')");
            echo "ok";
        } else {
            echo "Clave inválida";
        }
    } else
        echo "Debe ingresar su clave de usuario para confirmar";
    } else{
        echo "Ingrese todos los datos indicados";
    }
     
} else
    header("Location: ../404");