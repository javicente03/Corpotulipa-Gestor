<?php
if(isset($router)){
    $id = $_POST['id'];
    if($id!=""){
        include("bd.php");

        $sql="DELETE FROM permisos WHERE permiso_id='$id'";
        $proceso=$bd->query($sql);
        if($proceso)
            echo "ok";
        else
            echo "¡Oh no, ocurrió un error inesperado!";
    } else {
        echo "Debe enviar el id";
    }
} else {
    header("Location: ../404");
}