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
    $json = json_encode(array('texto' => 'Debe completar todos los campos'));
    echo $json;
}
} else {
    header("Location: ../404");
}