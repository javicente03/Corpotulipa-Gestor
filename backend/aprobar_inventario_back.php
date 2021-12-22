<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    $motivo = trim(addslashes($_POST["motivo"]));
    $user = $_SESSION["id"];
    if(!isset($_POST["accion"])){
        echo "Debe seleccionar una acción";
    } else{
        $accion = $_POST["accion"];
        if($clave !=""){
            include("bd.php");
            $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
            if(password_verify($clave, $usuario['password'])){
                $date = date("Y-m-d");
                $ultimo = ($bd->query("SELECT * FROM inventario ORDER BY id_inventario DESC LIMIT 1")->fetch_assoc());
                $solicitante = $ultimo["solicitante"];
                if($accion == "Rechazar"){
                    if($motivo !=""){
                        $rechazar = $bd->query("UPDATE inventario SET rechazado = true,
                                                razon_rechazo = '$motivo', respuesta = '$user'
                                                WHERE id_inventario = ".$ultimo["id_inventario"]);
                        $texto = "Ha sido rechazada tu solicitud más reciente de toma de inventario. Revisa el motivo.";
                        $link = "programar_inventario";
                        $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) 
                                    VALUES ('$solicitante','$texto','$date','$link')");
                        echo "ok";
                    } else
                        echo "Debe indicar un motivo";
                } else {
                    $aprobar = $bd->query("UPDATE inventario SET aprobado = true,
                                            respuesta = '$user' WHERE id_inventario = ".$ultimo["id_inventario"]);

                    include("backend/bd.php");
                    $gerentes = $bd->query("SELECT * FROM perfil P INNER JOIN usuario U ON P.id_usuario=U.id
                                            LEFT JOIN cargo C ON P.cargo_id=C.cargo_id WHERE C.cargo = 'Gerente'");

                    $texto = "Ha sido programado una toma de inventario físico, por favor prepare su unidad.";
                    $link = "levantar_inventario";
                    while ($gerente = $gerentes->fetch_assoc()) {
                        $id_user = $gerente["id"];
                        $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) 
                                    VALUES ('$id_user','$texto','$date','$link')");
                    }

                    $texto = "Ha sido aprobada tu solicitud más reciente de toma de inventario.";
                    $link = "programar_inventario";
                    $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) 
                                    VALUES ('$solicitante','$texto','$date','$link')");
                    echo "ok";
                }
            } else
                echo "Clave inválida";
        } else
            echo "Debe completar todos los datos";
    }
} else
    header("Location: ../404");