<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    $motivo = trim(addslashes($_POST["motivo"]));
    $user = $_SESSION["id"];
    if(!isset($_POST["accion"])){
        echo "Debe seleccionar una acción";
    } else{
        $accion = $_POST["accion"];
        if($clave !="" && $motivo !=""){
            include("bd.php");
            $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
            if(password_verify($clave, $usuario['password'])){
                $date = date("Y-m-d");
                if($accion == "Rechazar"){
                    if($motivo !=""){
                        $rechazar = $bd->query("UPDATE inventario SET rechazado = true,
                                                razon_rechazo = '$motivo', respuesta = '$user'");
                        echo "ok";
                    } else
                        echo "Debe indicar un motivo";
                } else {
                    $aprobar = $bd->query("UPDATE inventario SET aprobado = true,
                                            respuesta = '$user'");
                    echo "ok";
                }
            } else
                echo "Clave inválida";
        } else
            echo "Debe completar todos los datos";
    }
} else
    header("Location: ../404");