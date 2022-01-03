<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            include("validaciones.php");
            $fecha = $_POST["fecha"];
            if(validar_fecha($fecha) && $fecha >= date("Y-m-d")){
                $institucion = trim(addslashes($_POST["institucion"]));
                $lugar = trim(addslashes($_POST["lugar"]));
                $duracion = trim(addslashes($_POST["duracion"]));
                $costo = trim(addslashes($_POST["costo"]));
                $telf = trim(addslashes($_POST["telf"]));
                $partida = trim(addslashes($_POST["partida"]));
                $recomendaciones = trim(addslashes($_POST["recomendaciones"]));
                $solicitud = $_POST["solicitud"];
                if($institucion!="" && $lugar!="" && $duracion!="" && $costo!="" 
                    && $telf!="" && isset($_POST["presupuesto"]) && $partida!="" && $recomendaciones!=""){
                    if(is_numeric($costo)){
                        $p = false;
                    if($_POST["presupuesto"] =="Si")
                        $p = true;

                        $bd->query("UPDATE adiestramiento SET fecha_adiestramiento='$fecha',
                        institucion='$institucion',lugar_evento='$lugar',duracion='$duracion',
                        costo_unitario='$costo',telefono='$telf',disponibilidad_presupuestaria='$p',
                        partida='$partida',recomendaciones='$recomendaciones' 
                        WHERE id_adiestramiento = $solicitud");

                        echo "ok";
                    } else
                        echo "El costo debe ser numérico";
                } else
                    echo "Debe completar todos los datos solicitados";
            } else
                echo "La fecha que indicó es inválida";
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar su clave de seguridad";
} else
    header("Location: ../404");