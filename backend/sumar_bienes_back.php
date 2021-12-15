<?php
if(isset($router)){
    $cantidad = trim(addslashes($_POST['cantidad']));
    $bien = trim(addslashes($_POST['bien']));
    $date = date("Y-m-d");
    $user = $_SESSION["id"];

    if($cantidad != ""){
        if(is_numeric($cantidad) && $cantidad > 0){
            include("bd.php");
            $mueble = ($bd->query("SELECT * FROM bienes_publicos WHERE id_bien = ".$bien)->fetch_assoc());
            if($mueble){
                if($mueble["tipo"] == "Mueble"){
                    $nueva = $cantidad + $mueble["existencia"];
                    $incorporar = $bd->query("INSERT INTO incorporacion_bien (id_bien,cantidad,fecha_incorporaciones) VALUES ('$bien','$cantidad','$date')");
                    $sumar = $bd->query("UPDATE bienes_publicos SET existencia = '$nueva' WHERE id_bien = $bien");
                    if($incorporar && $sumar)
                        echo "ok";
                    else
                        echo "¡Oh no! ha ocurrido un error inesperado";
                } else
                    echo "El tipo de bien es Inmueble, no acepta nuevas incorporaciones";
            } else
                echo "Bien público no encontrado";
        } else {
            echo "La cantidad debe ser numérica y mayor a 0";
        }
    } else {
        echo "Debe completar todos los datos requeridos";
    }
    
} else {
    header("Location: ../404");
}