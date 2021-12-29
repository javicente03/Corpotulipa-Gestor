<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            include("validaciones.php");
            $fecha = $_POST["fecha"];
            $responsable = $_POST["responsable"];
            $fecha_valida = validar_fecha($fecha);
            $hoy = date('Y-m-d');
            if($fecha_valida && $fecha >= $hoy){
                $array = json_decode($_POST['array']);
                $texto = "Has sido invitado a recibir una charla de inducción el dia $fecha, por favor completa el test luego de asistir";
                foreach ($array as $key => $value) {
                    $bd->query("INSERT INTO induccion (id_usuario,fecha_induccion,responsable)
                                VALUES ('$value','$fecha','$responsable')");
                    $ultimo = ($bd->query("SELECT * FROM induccion ORDER BY id_induccion DESC LIMIT 1"))->fetch_assoc();
                    $link = "charla_induccion/".$ultimo["id_induccion"];
                    $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link)
                                VALUES ('$value','$texto','$hoy','$link')");
                }
                echo "ok";
            } else
                echo "Fecha inválida";
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar su clave de seguridad";
}