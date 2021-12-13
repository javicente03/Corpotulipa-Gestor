<?php
if(isset($router)){
    $tipo = trim(addslashes($_POST['tipo']));
    $organismo = trim(addslashes($_POST['organismo']));
    $denoOrga = trim(addslashes($_POST['denoOrga']));
    $departamento = trim(addslashes($_POST['departamento']));
    $denoDepa = trim(addslashes($_POST['denoDepa']));
    $dependencia = trim(addslashes($_POST['dependencia']));
    $denoUsu = trim(addslashes($_POST['denoUsu']));
    $cantidad = trim(addslashes($_POST['cantidad']));
    $mueble = trim(addslashes($_POST['mueble']));
    $descripcion = trim(addslashes($_POST['descripcion']));
    $catastro = trim(addslashes($_POST['catastro']));
    $inmueble = trim(addslashes($_POST['inmueble']));
    $valor = trim(addslashes($_POST['valor']));
    $responsable = trim(addslashes($_POST['responsable']));
    $date = date("Y-m-d");
    $year = date("Y");
    $year = substr($year,2,4);
    $user = $_SESSION["id"];

    if($tipo == "Mueble"){
        if($organismo!="" && $departamento!="" && $dependencia!="" && $valor!=""
            && $cantidad!="" && $mueble!="" && $descripcion!="" && $responsable!=""){
            if(is_numeric($cantidad) && is_numeric($valor)){
                include("bd.php");
                $len = ($bd->query("SELECT * FROM bienes_publicos"))->num_rows;
                $len = ($len+1);
                $siglas = ($bd->query("SELECT * FROM departamento WHERE departamento_id = $departamento"))->fetch_assoc();
                $codigo = $siglas["siglas"]."-".$year."-".$len;
                $insertar = $bd->query("INSERT INTO bienes_publicos (codigo,tipo,organismo,denoOrga,departamento_id,denoDepa,dependencia,denoUsu,existencia,nombre_bien,descripcion,fecha_incorporacion,incorporado_por,responsable,valor) VALUES ('$codigo','Mueble','$organismo','$denoOrga','$departamento','$denoDepa','$dependencia','$denoUsu','$cantidad','$mueble','$descripcion','$date','$user', '$responsable','$valor')");
                $verificacion = $bd->query("INSERT INTO verificacion_bienes (id_bien) VALUES ('$len')");
                $incorporar = $bd->query("INSERT INTO incorporacion_bien (id_bien,cantidad,fecha_incorporaciones) VALUES ('$len','$cantidad','$date')");
                if($insertar && $verificacion && $incorporar)
                    echo "ok";
                else
                    echo "¡Oh no! Ha ocurrido un error";
            } else {
                echo "La cantidad debe ser numérica";
            }
        } else {
            echo "Debe completar todos los datos requeridos";
        }
    } else if($tipo == "Inmueble"){
        if($organismo!="" && $departamento!="" && $dependencia!="" 
            && $inmueble!="" && $catastro!="" && $valor!="" && $responsable!=""){
            if(is_numeric($valor) && is_numeric($catastro)){
                include("bd.php");
                $len = ($bd->query("SELECT * FROM bienes_publicos"))->num_rows;
                $len = ($len+1);
                $siglas = ($bd->query("SELECT * FROM departamento WHERE departamento_id = $departamento"))->fetch_assoc();
                $codigo = $siglas["siglas"]."-".$year."-".$len;
                $insertar = $bd->query("INSERT INTO bienes_publicos (codigo,tipo,organismo,denoOrga,departamento_id,denoDepa,dependencia,denoUsu,nombre_bien,catastro,valor,fecha_incorporacion,incorporado_por,responsable) VALUES ('$codigo','Inmueble','$organismo','$denoOrga','$departamento','$denoDepa','$dependencia','$denoUsu','$inmueble','$catastro','$valor','$date','$user','$responsable')");
                $verificacion = $bd->query("INSERT INTO verificacion_bienes (id_bien) VALUES ('$len')");
                
                if($insertar)
                    echo "ok";
                else
                    echo "¡Oh no! Ha ocurrido un error";
            } else {
                echo "El valor y el catastro debe ser numérico";
            }
        } else {
            echo "Debe completar todos los datos requeridos";
        }
    }
} else {
    header("Location: ../404");
}