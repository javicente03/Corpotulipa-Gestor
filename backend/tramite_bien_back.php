<?php
if(isset($router)){
    $prestamo = $_POST["tramite"];
    $clave = trim(addslashes($_POST["clave"]));
    $observacion = trim(addslashes($_POST["observacion"]));

    if($clave != ""){
        include("bd.php");

        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $tramite = ($bd->query("SELECT * FROM tramite_bienes WHERE id_prestamo_bien = $prestamo"))->fetch_assoc();
            
            if($tramite["concepto"] == "Traslado"){
                if($_SESSION["id"]==$tramite["user1"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET analista = true, analista2 = true WHERE id_prestamo_bien = $prestamo");
                }
                if($_SESSION["id"]==$tramite["user2"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET coordinador = true, coordinador2 = true WHERE id_prestamo_bien = $prestamo");
                }
                if($_SESSION["id"]==$tramite["user3"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET entregado = true, entregado2 = true WHERE id_prestamo_bien = $prestamo");
                }
                if($_SESSION["id"]==$tramite["user4"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET recibido = true, recibido2 = true WHERE id_prestamo_bien = $prestamo");
                }
                $tramiteNuevo = ($bd->query("SELECT * FROM tramite_bienes WHERE id_prestamo_bien = $prestamo"))->fetch_assoc();
                if($tramiteNuevo["analista"] && $tramiteNuevo["analista2"] &&
                    $tramiteNuevo["coordinador"] && $tramiteNuevo["coordinador2"] &&
                    $tramiteNuevo["entregado"] && $tramiteNuevo["entregado2"] &&
                    $tramiteNuevo["recibido"] && $tramiteNuevo["recibido2"]){
                        $date = date("Y-m-d");
                        $finalizar = $bd->query("UPDATE tramite_bienes SET fecha_fin_tramite = '$date'");
                        $prestamoResponsable = ($bd->query("SELECT * FROM prestamo_bien T INNER JOIN bienes_publicos B
                                                            ON T.id_bien=B.id_bien WHERE id_prestamo_bien = $prestamo"))->fetch_assoc();
                        $updateResponsable = $bd->query("UPDATE bienes_publicos SET responsable=".$tramite["user4"].
                                                        " WHERE id_bien = ".$prestamoResponsable["id_bien"]);
                    }
            } else {
            
            if($_SESSION["id"]==$tramite["user1"]){
                if(!$tramite["analista"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET analista = true WHERE id_prestamo_bien = $prestamo");
                } else {
                    $tramitar = $bd->query("UPDATE tramite_bienes SET analista2 = true WHERE id_prestamo_bien = $prestamo");
                }
            }
            if($_SESSION["id"]==$tramite["user2"]){
                if(!$tramite["coordinador"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET coordinador = true WHERE id_prestamo_bien = $prestamo");
                } else {
                    $tramitar = $bd->query("UPDATE tramite_bienes SET coordinador2 = true WHERE id_prestamo_bien = $prestamo");
                }
            }
            if($_SESSION["id"]==$tramite["user3"]){
                if(!$tramite["entregado"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET entregado = true WHERE id_prestamo_bien = $prestamo");
                } else {
                    $tramitar = $bd->query("UPDATE tramite_bienes SET entregado2 = true WHERE id_prestamo_bien = $prestamo");
                }
            }
            if($_SESSION["id"]==$tramite["user4"]){
                if(!$tramite["recibido"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET recibido = true WHERE id_prestamo_bien = $prestamo");
                } else {
                    $tramitar = $bd->query("UPDATE tramite_bienes SET recibido2 = true WHERE id_prestamo_bien = $prestamo");
                }
            }

            $tramiteNuevo = ($bd->query("SELECT * FROM tramite_bienes WHERE id_prestamo_bien = $prestamo"))->fetch_assoc();
            if($tramiteNuevo["analista"] && $tramiteNuevo["analista2"] &&
                $tramiteNuevo["coordinador"] && $tramiteNuevo["coordinador2"] &&
                $tramiteNuevo["entregado"] && $tramiteNuevo["entregado2"] &&
                $tramiteNuevo["recibido"] && $tramiteNuevo["recibido2"]){
                    $date = date("Y-m-d");
                    $finalizar = $bd->query("UPDATE tramite_bienes SET fecha_fin_tramite = '$date'");
            }
            }

            if($observacion !=""){
                $bd->query("INSERT INTO observaciones_prestamo (id_prestamo_bien,texto) VALUES ('$prestamo','$observacion')");
            }
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar su clave de usuario para confirmar";
} else
    header("Location: ../404");