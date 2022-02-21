<?php
if(isset($router)){
    $clave = trim(addslashes($_POST['clave']));

    if($clave != ""){
        include("bd.php");

        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            if($pass == "cuentadante"){
                $ultima = $bd->query("UPDATE solicitud_repo_cc SET cuentadante = true WHERE id_solicitud_repo_cc = ".$_POST['id']);
                echo "ok";
            } else if($pass == "coordinador"){
                $ultima = $bd->query("UPDATE solicitud_repo_cc SET coordinador = true WHERE id_solicitud_repo_cc = ".$_POST['id']);
                echo "ok";
            } else if($pass == "analista"){
                $ultima = $bd->query("UPDATE solicitud_repo_cc SET analista = true WHERE id_solicitud_repo_cc = ".$_POST['id']);
                echo "ok";
            } else if($pass == "contador"){
                $ultima = $bd->query("UPDATE solicitud_repo_cc SET contador = true WHERE id_solicitud_repo_cc = ".$_POST['id']);
                echo "ok";
            } else if($pass == "gerente"){
                $bs = trim(addslashes($_POST["monto"]));
                if(is_numeric($bs) && $bs>0 && $bs !=""){
                    $ut_data = ($bd->query("SELECT * FROM ut WHERE utid = 1"))->fetch_assoc();
                    $ut_a_reponer = $bs / $ut_data['cambio_ut'];
                    $cc = ($bd->query("SELECT * FROM caja_chica WHERE idcc = 1"))->fetch_assoc();
                    $nueva_ut_reponer = $cc['fondo_actual'] + $ut_a_reponer;
                    $bd->query("UPDATE caja_chica SET fondo_actual = '$nueva_ut_reponer' WHERE idcc = 1");
                    $ultima = $bd->query("UPDATE solicitud_repo_cc SET gerente = true 
                                        WHERE id_solicitud_repo_cc = ".$_POST['id']);
                    echo "ok";
                } else
                    echo "Ingrese un monto válido";
            }
        } else {
            echo "Clave de seguridad inválida";
        }
    } else {
        echo "Debe ingresar su clave de usuario para confirmar";
    }
} else {
    header("Location: ../404");
}