<?php
if(isset($router)){
$rango = trim(addslashes($_POST['rango']));
$nombre = trim(addslashes($_POST['nombre']));
if($rango!="" && $nombre!=""){
    if(is_numeric($rango)){
        include("bd.php");

        $sql="SELECT * FROM cargo WHERE cargo='$nombre'";
        $proceso=$bd->query($sql);
        $len=$proceso->num_rows;

        if($len==0){
            $sql1="INSERT INTO cargo (rango,cargo) VALUES ('$rango','$nombre')";
            $proceso1=$bd->query($sql1);
            if($proceso1){
                echo "ok";
            } else {
                echo "¡Oh no, ocurrió un error inesperado!";
            }
        } else {
            echo "Este cargo ya existe";
        }
    } else {
        echo "El rango debe ser numérico";
    }
} else {
    echo "Debe completar todos los campos";
}
} else {
    header("Location: ../404");
}