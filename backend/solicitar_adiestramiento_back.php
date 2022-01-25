<?php
if(isset($router)){
    $array = json_decode($_POST['array']);
    if(count($array)>0){
        $clave = trim(addslashes($_POST["clave"]));
        if($clave != ""){
            include("bd.php");
            $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
            if(password_verify($clave, $usuario['password'])){
                $denominacion = trim(addslashes($_POST["denominacion"]));
                $meta = trim(addslashes($_POST["meta"]));
                $area = trim(addslashes($_POST["area"]));
                if(isset($_POST["metodo"]) && $denominacion!="" && $meta!="" && $area!=""){
                    $metodo = $_POST["metodo"];
                    $hoy = date("Y-m-d");
                    $bd->query("INSERT INTO adiestramiento (solicitante,fecha_solicitud,denominacion,
                    metodo,meta_asociada,area_conocimiento) VALUES 
                    ('".$_SESSION["id"]."','$hoy','$denominacion','$metodo','$meta','$area')");

                    $ultimo = ($bd->query("SELECT * FROM adiestramiento ORDER BY id_adiestramiento
                                DESC LIMIT 1"))->fetch_assoc();
                    foreach ($array as list($a,$b,$c)) {
                        $bd->query("INSERT INTO participante_adiestramiento 
                            (participante,nivel_requerido,nivel_actual,id_adiestramiento) 
                            VALUES('$a','$b','$c','".$ultimo["id_adiestramiento"]."')");
                    }
                    echo "ok";
                } else
                    echo "Debe completar todos los datos requeridos";
            } else 
                echo "Clave inválida";
        } else
            echo "Debe ingresar su clave de seguridad";
    } else
        echo "Debe seleccionar algún participante";
} else
    header("Location: ../404");