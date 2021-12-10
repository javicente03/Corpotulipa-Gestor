<?php
if(isset($router)){
$cargo = trim(addslashes($_POST['cargo']));
$departamento = trim(addslashes($_POST['departamento']));
$id = trim(addslashes($_POST['id']));


if($departamento != "" && $cargo != ""){
    include("bd.php");
    $usuario = "SELECT * FROM usuario WHERE id = $id";
    $proceso_user = $bd->query($usuario);
    if($proceso_user->num_rows > 0){
        $sql = "SELECT * FROM departamento WHERE departamento_id = ".$departamento;
        $proceso = $bd->query($sql);
        if($proceso->num_rows > 0){
            $sql1 = "SELECT * FROM cargo WHERE cargo_id = ".$cargo;
            $proceso1 = $bd->query($sql1);
            if($proceso1->num_rows > 0){
                $data = $proceso_user->fetch_assoc();
                $sql2 ="UPDATE perfil SET cargo_id = '$cargo', departamento_id = '$departamento' WHERE id_usuario = $id";
                $proceso2 = $bd->query($sql2);
                if($proceso2)
                    echo "ok";
                else
                    echo "¡Oh no! Ha ocurrido un error inesperado";
            } else {
                echo "Cargo no existente";
            }
        } else {
            echo "Departamento no existente";
        }
    } else {
        echo "Usuario no existente";
    }
} else {
    echo "Debe completar todos los datos correctamente";
}
} else {
    header("Location: ../404");
}