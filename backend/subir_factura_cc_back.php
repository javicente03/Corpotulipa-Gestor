<?php
if(isset($router)){
    if(!empty($_FILES['factura']['tmp_name'])){
        $id = $_POST['id'];
        include("backend/bd.php");
        $nro_fact = ($bd->query("SELECT * FROM facturas_cc WHERE id_sol_cc = $id"))->num_rows;
        include("imagenes/ajuste_factura.php");
        $tipo = $_FILES["factura"]["type"];
        $archivo = $_FILES["factura"]["tmp_name"];
        $nombre = "sol".$id."n".($nro_fact+1);
        $upload = subir_imagen($tipo,$archivo,$nombre);
        if($upload)
            $thumb = "frontend/img/facturas_cc/".$nombre.$upload;
        else
            $thumb = "fail";

        if($thumb != "fail"){
            $bd->query("UPDATE solicitud_cc SET efectuado = true WHERE id_sol_cc = $id");
            $bd->query("INSERT INTO facturas_cc (id_sol_cc,factura) VALUES ('$id','$thumb')");
            echo "ok";
        } else 
            echo "Archivo inválido, debe subir una imágen JPEG, PNG o GIF";
    } else {
        echo "Debe seleccionar un archivo";
    }
} else {
    header("Location: ../404");
}