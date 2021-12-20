<?php
if(isset($router)){
    $id_reporte = $_POST["reporte"];
    $clave = trim(addslashes($_POST["clave"]));

    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $date = date("Y-m-d");
            $reporte = ($bd->query("SELECT * FROM reporte_bien R 
                                LEFT JOIN bienes_publicos B ON R.id_bien = B.id_bien
                                WHERE id_reporte_bien = $id_reporte"))->fetch_assoc();
            $bien = $bd->query("UPDATE reporte_bien SET desincorporado = true, fecha_desincorporacion = '$date'
                                WHERE id_reporte_bien = $id_reporte");
            $bien = $bd->query("UPDATE bienes_publicos SET existente = false WHERE id_bien = ".$reporte["id_bien"]);
            echo "ok";
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar su clave";
} else
    header("Location: ../404");