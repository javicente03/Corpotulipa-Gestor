<?php
if(isset($router)){
    $conocimientos = trim(addslashes($_POST["conocimientos"]));
    $recomendaciones = trim(addslashes($_POST["recomendaciones"]));

    if(isset($_POST["primera"]) && isset($_POST["segunda"]) && isset($_POST["tercera"]) &&
    isset($_POST["cuarta"]) && isset($_POST["quinta"]) && isset($_POST["sexta"]) &&
    isset($_POST["septima"]) && $conocimientos!="" && $recomendaciones!=""){
        $primera = $_POST["primera"];
        $segunda = $_POST["segunda"];
        $tercera = $_POST["tercera"];
        $cuarta = $_POST["cuarta"];
        $quinta = $_POST["quinta"];
        $sexta = $_POST["sexta"];
        $septima = $_POST["septima"];

        include("bd.php");
        $adiestramiento = ($bd->query("SELECT * FROM adiestramiento 
                            WHERE id_adiestramiento = ".$_POST["adiestramiento"]))->fetch_assoc();
        if($adiestramiento){
            $bd->query("UPDATE participante_adiestramiento SET pregunta1='$primera',pregunta2='$segunda',
                pregunta3='$tercera',pregunta4='$cuarta',pregunta5='$quinta',pregunta6='$sexta',pregunta7='$septima',
                conocimientos_adquiridos='$conocimientos',recomendaciones='$recomendaciones' 
                WHERE id_adiestramiento = ".$_POST["adiestramiento"]." AND participante = ".$_SESSION["id"]);
            echo "ok";
        } else
            echo "Adiestramiento no encontrado";
    } else
        echo "Debe completar todos los datos solicitados";
} else
    header("Location: ../404");