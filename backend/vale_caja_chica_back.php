<?php
if(isset($router)){
    $bs = trim(addslashes($_POST['bs']));
    $motivo = trim(addslashes($_POST['motivo']));

    if($bs != "" || $motivo != ""){
        if(is_numeric($bs)){
            include("bd.php");
            $sql = "SELECT * FROM ut WHERE utid = 1";
            $ut = ($bd->query($sql))->fetch_assoc();
            $utpedida = $bs / $ut['cambio_ut'];
            if($utpedida <= $ut['ut']){
                $id = $_SESSION['id'];
                $fecha = date("Y-m-d");
                $solicitud = "INSERT INTO solicitud_cc (id_usuario,fecha,bs,ut_pedido,motivo) VALUES ('$id','$fecha','$bs','$utpedida','$motivo')";
                $solicitar = $bd->query($solicitud);
                if($solicitar)
                    echo "ok";
                else
                    echo "¡Oh no! ha ocurrido un error inesperado";
            } else {
                echo "El monto solicitado es mayor al descrito por el control de caja chica";
            }
        } else {
            echo "El monto solicitado debe ser numérico";
        }
    } else {
        echo "Debe completar todos los datos solicitados";
    }
} else {
    header("Location: ../404");
}