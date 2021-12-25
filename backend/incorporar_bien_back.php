<?php
if(isset($router)){
    $tipo = trim(addslashes($_POST['tipo']));
    $organismo = trim(addslashes($_POST['organismo']));
    $denoOrga = trim(addslashes($_POST['denoOrga']));
    $departamento = trim(addslashes($_POST['departamento']));
    $denoDepa = trim(addslashes($_POST['denoDepa']));
    $dependencia = trim(addslashes($_POST['dependencia']));
    $denoUsu = trim(addslashes($_POST['denoUsu']));
    $mueble = trim(addslashes($_POST['mueble']));
    $descripcion = trim(addslashes($_POST['descripcion']));
    $catastro = trim(addslashes($_POST['catastro']));
    $inmueble = trim(addslashes($_POST['inmueble']));
    $valor = trim(addslashes($_POST['valor']));
    $responsable = trim(addslashes($_POST['responsable']));
    $catalogo = trim(addslashes($_POST['catalogo']));
    $date = date("Y-m-d");
    $year = date("Y");
    $year = substr($year,2,4);
    $user = $_SESSION["id"];

    if($tipo == "Mueble"){
        if($organismo!="" && $departamento!="" && $dependencia!="" && $valor!=""
            && $mueble!="" && $descripcion!="" && $responsable!="" && $catalogo!=""){
            if(is_numeric($valor)){
                include("bd.php");
                $siglas = ($bd->query("SELECT * FROM departamento WHERE departamento_id = $departamento"))->fetch_assoc();
                $insertar = $bd->query("INSERT INTO bienes_publicos (codigo,catalogo,tipo,organismo,denoOrga,departamento_id,denoDepa,dependencia,denoUsu,nombre_bien,descripcion,fecha_incorporacion,incorporado_por,responsable,valor) VALUES ('','$catalogo','Mueble','$organismo','$denoOrga','$departamento','$denoDepa','$dependencia','$denoUsu','$mueble','$descripcion','$date','$user', '$responsable','$valor')");
                $anterior = ($bd->query("SELECT * FROM bienes_publicos ORDER BY id_bien DESC LIMIT 1")->fetch_assoc());
                $anterior_id = $anterior["id_bien"];
                $codigo = $siglas["siglas"]."-".$year."-".$anterior_id;
                $indicar_codigo = $bd->query("UPDATE bienes_publicos SET codigo = '$codigo' WHERE id_bien = $anterior_id");
                $verificacion = $bd->query("INSERT INTO verificacion_bienes (id_bien) VALUES ('$anterior_id')");
                if($insertar && $verificacion)
                    echo "ok";
                else
                    echo "¡Oh no! Ha ocurrido un error";
            } else {
                echo "El valor debe ser numérico";
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