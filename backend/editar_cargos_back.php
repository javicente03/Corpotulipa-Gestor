<?php
if(isset($router)){
$id = trim(addslashes($_POST['id']));
$rango = trim(addslashes($_POST['rango']));
$nombre = trim(addslashes($_POST['nombre']));
if($rango!="" && $nombre!=""){
    if(is_numeric($rango)){
        include("bd.php");

        $sql="SELECT * FROM cargo WHERE cargo='$nombre' AND cargo_id!='$id'";
        $proceso=$bd->query($sql);
        $len=$proceso->num_rows;

        if($len==0){
            $sql1="UPDATE cargo SET rango='$rango',cargo='$nombre' WHERE cargo_id=$id";
            $proceso1=$bd->query($sql1);
            if($proceso){
                echo ("ok");
            } else {
                echo "¡Oh no, ocurrió un error inesperado!";
            }
        } else {
            echo "Este nombre de cargo ya existe";
        }
    } else {
        echo "El rango debe ser numérico";
    }
} else {
    echo "Debe completar todos los campos";
}
} else 
    header("Location: ../404");
