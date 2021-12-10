<?php
if(isset($router)){
    include("bd.php");
    $id = $_POST['id'];
    $sql = "UPDATE solicitud_cc SET validado = true WHERE id_sol_cc = $id";
    $query = $bd->query($sql);
    if($query){
        echo "ok";
    } else {
        echo "¡Oh no! ha ocurrido un error inesperado";
    }
} else {
    header("Location: ../404");
}