<?php
if(isset($router)){
    $incorporacion = $_POST["incorporacion"];
    $revisado = $_POST["revisado"];
    $verificado = $_POST["verificado"];
    $validado = $_POST["validado"];
    $date = date("Y-m-d");
    $texto1 = "Has sido encargado de revisar la incorporación de un bien público, ve a la sección correspondiente.";
    $texto2 = "Has sido encargado de verificar la incorporación de un bien público, ve a la sección correspondiente.";
    $texto3 = "Has sido encargado de validar la incorporación de un bien público, ve a la sección correspondiente.";
    $link = "verificar_bien";

    include("bd.php");
    $insertar = $bd->query("UPDATE verificacion_bienes SET user1='$revisado',user2='$verificado',user3='$validado' WHERE id_bien=$incorporacion");
    $noti1 = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) VALUES ('$revisado','$texto1','$date','$link')");
    $noti2 = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) VALUES ('$verificado','$texto2','$date','$link')");
    $noti3 = $bd->query("INSERT INTO notificaciones (id_usuario,texto,fecha,link) VALUES ('$validado','$texto3','$date','$link')");
    echo "ok";
}