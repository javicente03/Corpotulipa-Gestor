<?php
if(isset($router)){
    $ut = trim(addslashes($_POST['ut']));
    $cambio = trim(addslashes($_POST['cambio']));
    if($ut != "" && $cambio != "" && is_numeric($ut) && is_numeric($cambio)){
        include("bd.php");
        $proceso = $bd->query("UPDATE ut SET ut = '$ut', cambio_ut = '$cambio' WHERE utid = 1");
        if($proceso)
            echo "ok";
        else
            echo "¡Oh no! ha ocurrido un error inesperado";
    } else {
        echo "Debe completar todos los campos y estos deben ser numéricos";
    }   
} else {
    header("Location: ../404");
}