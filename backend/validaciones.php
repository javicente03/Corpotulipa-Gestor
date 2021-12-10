<?php
if(isset($router)){
function validar_fecha($nacimiento){
    $validate_fechas = explode("-",$nacimiento);
    if(count($validate_fechas) == 3 && checkdate($validate_fechas[1],$validate_fechas[2],$validate_fechas[0])){
        return true;
    } else {
        return false;
    }
}

function operaciones_fecha($fecha, $operacion){
    $fecha_actual = date("d-m-Y");
    $resultado = date("d-m-Y",strtotime($fecha.$operacion));
    return $resultado;
}

function calcular_fecha($fecha1, $fecha2){
    $d1 = DateTime::createFromFormat('j-m-y', $fecha1);
    $d2 = DateTime::createFromFormat('j-m-y', $fecha2);
    $diff = $d1->diff($d2);
    return $diff;
}

function validar_email($email){
    $validate_email = explode("@", $email);
    if(count($validate_email) == 2 && $validate_email[1] == "gmail.com"){
        return true;
    } else {
        return false;
    }
}
} else {
    header("Location: ../404");
}