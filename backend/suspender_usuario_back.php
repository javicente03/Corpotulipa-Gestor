<?php
if(isset($router)){
    $id = trim(addslashes($_POST['id']));
    $accion = trim(addslashes($_POST['accion']));
    if($id != "" && $accion != ""){
        if($accion == "active" || $accion == "suspended"){
            $conn=0;
            include("bd.php");
            $sql = "UPDATE usuario SET status='$accion' WHERE id = $id";
            $proceso = $bd->query($sql);
            if($proceso)
                echo "ok";
            else
                echo "¡Oh no, ocurrió un error inesperado!";
        } else {
            echo "Estatus no válido";
        }
    } else {
        echo "Debe completar los datos correctamente";
    }
} else {
    header("Location: ../404");
}