<?php

if(isset($router)){
$siglas = trim(addslashes($_POST['siglas']));
$nombre = trim(addslashes($_POST['nombre']));
if($siglas!="" && $nombre!=""){
    include("bd.php");

	$sql="SELECT * FROM departamento WHERE departamento='$nombre'";
	$proceso=$bd->query($sql);
    $len=$proceso->num_rows;

    if($len==0){
        $sql1="INSERT INTO departamento (siglas,departamento) VALUES ('$siglas','$nombre')";
		$proceso1=$bd->query($sql1);
        if($proceso1){
            $sql2 = "SELECT departamento_id FROM departamento ORDER BY departamento_id DESC LIMIT 1";
            $proceso2=$bd->query($sql2);
            $data =  $proceso2->fetch_assoc();
            $json = json_encode(array('id' => $data['departamento_id'], 'texto' => 'ok'));
            echo $json;
        } else {
            $json = json_encode(array('texto' => '¡Oh no, ocurrió un error inesperado!'));
            echo $json;
        }
    } else {
        $json = json_encode(array('texto' => 'Este nombre de departamento ya existe'));
        echo $json;
    }
} else {
    $json = json_encode(array('texto' => 'Debe completar todos los campos'));
    echo $json;
}
} else {
    header("Location: ../404");
}