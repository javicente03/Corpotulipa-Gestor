<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $cuadernillo = false;
            $descripcion = false;
            $politica = false;
            if(isset($_POST["cuadernillo"]))
                $cuadernillo = true;
            if(isset($_POST["descripcion"]))
                $descripcion = true;
            if(isset($_POST["politica"]))
                $politica = true;
            $hoy = date('Y-m-d');
            $bd->query("UPDATE induccion SET cuadernillo='$cuadernillo',descripcion='$descripcion',
                        politica='$politica',fecha_respuesta='$hoy'
                        WHERE id_usuario = ".$_SESSION["id"]);
            echo "ok";
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar su clave de seguridad";
} else
    header("Location: ../404");