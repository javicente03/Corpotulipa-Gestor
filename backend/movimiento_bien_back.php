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
            if($tipo == "Externo"){
                $razon = trim(addslashes($_POST["razon"]));
                $rif = trim(addslashes($_POST["rif"]));
                $direccion = trim(addslashes($_POST["direccion"]));
                $persona_re = trim(addslashes($_POST["nombre_responsable"]));
                $fijo = trim(addslashes($_POST["telefono_fijo"]));
                $contacto = trim(addslashes($_POST["telefono_contacto"]));

                if($razon!="" && $rif!="" && $direccion!="" && $persona_re!="" && $fijo!="" && $contacto!=""){
                    $juridica = $bd->query("INSERT INTO persona_juridica (id_prestamo_bien,razon_social,rif,direccion_fiscal,telefono_fijo,persona_responsable,telefono_contacto) 
                                            VALUES ('$prestamo','$razon','$rif','$direccion','$fijo','$persona_re','$contacto')");
                    tramitar($router,$prestamo,$tipo,$concepto,$usuario_id,$coordinador,$responsable,$solicitante,$date,$texto,$link);
                } else {
                    echo "Debe ingresar todos los datos solicitados";
                }
            } else {
                tramitar($router,$prestamo,$tipo,$concepto,$usuario_id,$coordinador,$responsable,$solicitante,$date,$texto,$link);
            }
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


function tramitar($router,$prestamo,$tipo,$concepto,$usuario_id,$coordinador,$responsable,$solicitante,$date,$texto,$link){
    include("bd.php");
    
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
}