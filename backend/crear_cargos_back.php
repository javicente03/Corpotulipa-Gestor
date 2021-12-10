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
                $sql2 = "SELECT cargo_id FROM cargo ORDER BY cargo_id DESC LIMIT 1";
                $proceso2=$bd->query($sql2);
                $data =  $proceso2->fetch_assoc();
                $json = json_encode(array('id' => $data['cargo_id'], 'texto' => 'ok'));
                echo $json;
            } else {
                $json = json_encode(array('texto' => '¡Oh no, ocurrió un error inesperado!'));
                echo $json;
            }
        } else {
            $json = json_encode(array('texto' => 'Este cargo ya existe'));
            echo $json;
        }
    } else {
        $json = json_encode(array('texto' => 'El rango debe ser numérico'));
        echo $json;
    }
} else {
    $json = json_encode(array('texto' => 'Debe completar todos los campos'));
    echo $json;
}
} else {
    header("Location: ../404");
}