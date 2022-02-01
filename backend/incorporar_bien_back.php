<?php
if (isset($router)) {
    $organismo = trim(addslashes($_POST['organismo']));
    $departamento = trim(addslashes($_POST['departamento']));
    $dependencia = trim(addslashes($_POST['dependencia']));
    $mueble = trim(addslashes($_POST['mueble']));
    $descripcion = trim(addslashes($_POST['descripcion']));
    $catastro = trim(addslashes($_POST['catastro']));
    $inmueble = trim(addslashes($_POST['inmueble']));
    $valor = trim(addslashes($_POST['valor']));
    $responsable = trim(addslashes($_POST['responsable']));
    $catalogo = trim(addslashes($_POST['catalogo']));
    $date = date("Y-m-d");
    $year = date("Y");
    $year = substr($year, 2, 4);
    $user = $_SESSION["id"];

    if (isset($_POST["tipo"])) {
        $tipo = trim(addslashes($_POST['tipo']));
        if ($tipo == "Mueble") {
            if (
                $organismo != "" && $departamento != "" && $dependencia != "" && $valor != ""
                && $mueble != "" && $descripcion != "" && $responsable != "" && $catalogo != ""
            ) {
                if (is_numeric($valor)) {
                    if(strlen($descripcion) <= 2000){
                        include("bd.php");
                        $siglas = ($bd->query("SELECT * FROM departamento WHERE departamento_id = $departamento"))->fetch_assoc();
                        $insertar = $bd->query("INSERT INTO bienes_publicos (codigo,catalogo,tipo,organismo,departamento_id,dependencia,nombre_bien,descripcion,fecha_incorporacion,incorporado_por,responsable,valor) VALUES ('','$catalogo','Mueble','$organismo','$departamento','$dependencia','$mueble','$descripcion','$date','$user', '$responsable','$valor')");
                        $anterior = ($bd->query("SELECT * FROM bienes_publicos ORDER BY id_bien DESC LIMIT 1")->fetch_assoc());
                        $anterior_id = $anterior["id_bien"];
                        $codigo = $siglas["siglas"] . "-" . $year . "-" . $anterior_id;
                        $indicar_codigo = $bd->query("UPDATE bienes_publicos SET codigo = '$codigo' WHERE id_bien = $anterior_id");
                        $verificacion = $bd->query("INSERT INTO verificacion_bienes (id_bien) VALUES ('$anterior_id')");
                        if ($insertar && $verificacion)
                            echo "ok";
                        else
                            echo "¡Oh no! Ha ocurrido un error";
                    } else
                        echo "La descripción no debe exceder los 2000 caracteres";
                } else {
                    echo "El valor debe ser numérico";
                }
            } else {
                echo "Debe completar todos los datos requeridos";
            }
        } else if ($tipo == "Inmueble") {
            if (
                $organismo != "" && $departamento != "" && $dependencia != ""
                && $inmueble != "" && $catastro != "" && $valor != "" && $responsable != ""
            ) {
                if (is_numeric($valor) && is_numeric($catastro)) {
                    include("bd.php");
                    $siglas = ($bd->query("SELECT * FROM departamento WHERE departamento_id = $departamento"))->fetch_assoc();
                    $insertar = $bd->query("INSERT INTO bienes_publicos (codigo,tipo,organismo,departamento_id,dependencia,nombre_bien,catastro,valor,fecha_incorporacion,incorporado_por,responsable) VALUES ('','Inmueble','$organismo','$departamento','$dependencia','$inmueble','$catastro','$valor','$date','$user','$responsable')");
                    $anterior = ($bd->query("SELECT * FROM bienes_publicos ORDER BY id_bien DESC LIMIT 1")->fetch_assoc());
                    $anterior_id = $anterior["id_bien"];
                    $codigo = $siglas["siglas"] . "-" . $year . "-" . $anterior_id;
                    $indicar_codigo = $bd->query("UPDATE bienes_publicos SET codigo = '$codigo' WHERE id_bien = $anterior_id");
                    $verificacion = $bd->query("INSERT INTO verificacion_bienes (id_bien) VALUES ('$anterior_id')");

                    if ($insertar)
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
    } else
        echo "Debe seleccionar si el bien es mueble o inmueble";
} else {
    header("Location: ../404");
}
