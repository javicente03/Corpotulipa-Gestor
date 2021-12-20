<?php
if(isset($router)){
    if(isset($_POST["motivo"])){
        $clave = trim(addslashes($_POST["clave"]));
        $motivo = trim(addslashes($_POST["motivo"]));
        $descripcion = trim(addslashes($_POST["descripcion"]));
        $id_bien = $_POST["bien"];

        if($clave !="" && $motivo !="" && $descripcion !=""){
            include("bd.php");
            $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
            if(password_verify($clave, $usuario['password'])){
                $reporte = $bd->query("INSERT INTO reporte_bien (id_bien,motivo_reporte,descripcion_reporte) 
                                        VALUES ('$id_bien','$motivo','$descripcion')");
                $bien = $bd->query("UPDATE bienes_publicos SET existente = false WHERE id_bien = $id_bien");
                
                echo "ok";
            } else
                echo "Clave inválida";
        } else {
            echo "Debe ingresar todos los datos correspondientes";
        }
    } else
        echo "Seleccione un motivo";
} else
    header("Location: ../404");