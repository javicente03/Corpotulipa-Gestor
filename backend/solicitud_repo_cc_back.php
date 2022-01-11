<?php
if(isset($router)){
    $clave = trim(addslashes($_POST['clave']));
    $fondo = trim(addslashes($_POST['monto']));

    if($clave != ""){
        include("bd.php");

        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $date = date("Y-m-d");
            $ultima = ($bd->query("SELECT * FROM solicitud_repo_cc ORDER BY id_solicitud_repo_cc DESC LIMIT 1"))->fetch_assoc();
            $bd->query("INSERT INTO solicitud_repo_cc (fecha,fondo_momento,custodio) VALUES ('$date','$fondo',true)");
            if(isset($ultima['fecha'])){
                $anterior = $ultima['fecha'];
                $sql = "SELECT * FROM solicitud_cc INNER JOIN usuario ON solicitud_cc.id_usuario = usuario.id INNER JOIN perfil ON usuario.id = perfil.id_usuario LEFT JOIN departamento ON perfil.departamento_id = departamento.departamento_id WHERE validado = true AND fecha > '$anterior' AND fecha <= '$date'";
                // $sql = "SELECT * FROM solicitud_cc INNER JOIN usuario ON solicitud_cc.id_usuario = usuario.id INNER JOIN perfil ON usuario.id = perfil.id_usuario LEFT JOIN departamento ON perfil.departamento_id = departamento.departamento_id WHERE validado = true AND fecha BETWEEN '$anterior' AND '$date'";
            } else{
                $sql = "SELECT * FROM solicitud_cc INNER JOIN usuario ON solicitud_cc.id_usuario = usuario.id INNER JOIN perfil ON usuario.id = perfil.id_usuario LEFT JOIN departamento ON perfil.departamento_id = departamento.departamento_id WHERE validado = true";
            }
            $repo_reciente = ($bd->query("SELECT * FROM solicitud_repo_cc ORDER BY id_solicitud_repo_cc DESC LIMIT 1"))->fetch_assoc();
            $id_repo_reciente = $repo_reciente["id_solicitud_repo_cc"];
            $solicitudes = $bd->query($sql);
            while ($data = $solicitudes->fetch_assoc()) {
                $id_actual = $data['id_sol_cc'];
                $bd->query("INSERT INTO relacion_solicitud_cc (id_solicitud_repo_cc,id_sol_cc) VALUES ('$id_repo_reciente','$id_actual')");
            }
            echo "ok";
        } else {
            echo "Clave inválida";
        }
    } else {
        echo "Debe ingresar su clave de usuario para confirmar";
    }
} else {
    header("Location: ../404");
}