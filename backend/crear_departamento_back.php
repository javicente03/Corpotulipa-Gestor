<?php

if(isset($router)){
$siglas = trim(addslashes($_POST['siglas']));
$nombre = trim(addslashes($_POST['nombre']));
$sede = trim(addslashes($_POST['sede']));
if($siglas!="" && $nombre!="" && $sede!=""){
    include("bd.php");
        $sql1="INSERT INTO departamento (siglas,departamento,sede) VALUES ('$siglas','$nombre','$sede')";
		$proceso1=$bd->query($sql1);
        if($proceso1){
            echo "ok";
        } else {
            echo "¡Oh no, ocurrió un error inesperado!";
        }
} else {
    echo "Debe completar todos los campos";
}
} else {
    header("Location: ../404");
}