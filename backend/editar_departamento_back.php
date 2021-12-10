<?php
if(isset($router)){
$id = trim(addslashes($_POST['id']));
$siglas = trim(addslashes($_POST['siglas']));
$nombre = trim(addslashes($_POST['nombre']));
if($siglas!="" && $nombre!=""){
    include("bd.php");

	$sql="SELECT * FROM departamento WHERE departamento='$nombre' AND departamento_id!='$id'";
	$proceso=$bd->query($sql);
    $len=$proceso->num_rows;

    if($len==0){
        $sql1="UPDATE departamento SET siglas='$siglas',departamento='$nombre' WHERE departamento_id=$id";
		$proceso1=$bd->query($sql1);
        if($proceso){
            echo ("ok");
        } else {
            echo "¡Oh no, ocurrió un error inesperado!";
        }
    } else {
        echo "Este nombre de departamento ya existe";
    }
} else {
    echo "Debe completar todos los campos";
}
} else {
    header("Location: ../404");
}