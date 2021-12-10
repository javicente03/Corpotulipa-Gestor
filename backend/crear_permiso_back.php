<?php
if(isset($router)){
$accion = trim(addslashes($_POST['accion']));
$cargo = trim(addslashes($_POST['cargo']));
if($accion!="" && $cargo!=""){
    include("bd.php");

        $sql="SELECT * FROM cargo WHERE cargo='$cargo'";
        $proceso=$bd->query($sql);
        $len=$proceso->num_rows;

        if($len==0){
            $sql1="INSERT INTO permisos (accion,cargo_id) VALUES ('$accion','$cargo')";
            $proceso1=$bd->query($sql1);
            if($proceso1){
                echo "ok";
            } else {
                echo "¡Oh no, ocurrió un error inesperado!";
            }
        } else {
            echo "Este cargo no existe";
        }
} else {
    echo "Debe completar todos los campos";
}
} else {
    header("Location: ../404");
}