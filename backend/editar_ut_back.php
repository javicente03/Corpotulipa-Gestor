<?php
if(isset($router)){
    $ut = trim(addslashes($_POST['ut']));
    $cambio = trim(addslashes($_POST['cambio']));
    $maximo = trim(addslashes($_POST['maximo_cc']));
    if($ut != "" && $cambio != "" && is_numeric($ut) && is_numeric($cambio) && $maximo != "" && is_numeric($maximo)){
        include("bd.php");
        $proceso = $bd->query("UPDATE ut SET ut = '$ut', cambio_ut = '$cambio' WHERE utid = 1");
        $proceso1 = $bd->query("UPDATE caja_chica SET fondo_maximo = '$maximo' WHERE idcc = 1");
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