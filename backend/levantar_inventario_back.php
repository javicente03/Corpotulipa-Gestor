<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $user = $_SESSION["id"];
            $date = date("Y-m-d");
            $ultimo = ($bd->query("SELECT * FROM inventario WHERE aprobado = true ORDER BY id_inventario DESC LIMIT 1"))->fetch_assoc();
            $ultimo_id = $ultimo["id_inventario"];
            $levantar = $bd->query("INSERT INTO inventario_departamento (id_inventario,gerente,fecha_inventario_dep)
                                    VALUES ('$ultimo_id','$user','$date')");
            $ultimo1 = ($bd->query("SELECT * FROM inventario_departamento ORDER BY id_inventario DESC LIMIT 1"))->fetch_assoc();
            $ultimo_id1 = $ultimo1["id_inventario_departamento"];
            $array = json_decode($_POST['array']);
            foreach ($array as $key => $value) {
                $data_inventario = $bd->query("INSERT INTO inventario_data (id_inventario_departamento,id_bien)
                                    VALUES ('$ultimo_id1','$value')");
            }
            echo "ok";
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar la clave de seguridad";
} else
    header("Location: ../404");