<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            if(!isset($_POST["motive"])){
                $array = json_decode($_POST['array']);
                $id_inventario = $_POST["inventario"];
                $inventario = ($bd->query("SELECT * FROM inventario_departamento WHERE id_inventario_departamento = $id_inventario"))->fetch_assoc();
                if($inventario){
                    foreach ($array as $key => $value) {
                        $bd->query("DELETE FROM inventario_data WHERE id_bien = $value AND id_inventario_departamento = $id_inventario");
                    }
                    $obtener_total = ($bd->query("SELECT SUM(valor) FROM inventario_data ID LEFT JOIN bienes_publicos B ON ID.id_bien = B.id_bien WHERE id_inventario_departamento = $id_inventario"))->fetch_assoc();            
                    $valor_total = $obtener_total["SUM(valor)"];
                    $bd->query("UPDATE inventario_departamento SET valor_total = '$valor_total',verificado=true WHERE id_inventario_departamento = $id_inventario");
                    echo "ok";
                } else
                    echo "Toma de inventario no encontrada";
            } else {
                $date = date("Y-m-d");
                $bd->query("UPDATE inventario SET fecha_fin_inventario = '$date' ORDER BY id_inventario DESC LIMIT 1");
                echo "ok";
            }
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar la clave de seguridad";
} else
    header("Location: ../404");