<?php
if(isset($router)){
$id = trim(addslashes($_POST['id']));
$siglas = trim(addslashes($_POST['siglas']));
$nombre = trim(addslashes($_POST['nombre']));
$sede = trim(addslashes($_POST['sede']));
if($siglas!="" && $nombre!=""){
    include("bd.php");

        $sql1="UPDATE departamento SET siglas='$siglas',departamento='$nombre',sede='$sede' WHERE departamento_id=$id";
		$proceso1=$bd->query($sql1);
        if($proceso1){
            echo ("ok");
        } else {
            echo "¡Oh no, ocurrió un error inesperado!";
        }
} else {
    echo "Debe completar todos los campos";
}
} else {
    header("Location: ../404");
}