<?php
if(isset($router)){
$email = trim(addslashes($_POST['email']));
$password = trim(addslashes($_POST['password']));

if($email != "" && $password != ""){
    include("bd.php");
    $sql = "SELECT * FROM usuario INNER JOIN perfil ON usuario.id = perfil.id_usuario LEFT JOIN cargo ON perfil.cargo_id = cargo.cargo_id LEFT JOIN departamento ON perfil.departamento_id = departamento.departamento_id WHERE email = '$email'";
    $proceso = $bd->query($sql);
    if($data = $proceso->fetch_assoc()){
        if(password_verify($password, $data['password'])){
            if($data['status'] == "active"){
                $_SESSION['id'] = $data['id'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['apellido'] = $data['apellido'];
                $_SESSION['cedula'] = $data['cedula'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['permisos'] = $data['permisos'];
                $_SESSION['departamento_id'] = $data['departamento_id'];
                $_SESSION['cargo_id'] = $data['cargo_id'];
                $_SESSION['genero'] = $data['genero'];
                $_SESSION['img'] = $data['img'];
                $_SESSION['validado'] = $data['email_validado'];
                $_SESSION['birthday'] = $data['fecha_nacimiento'];
                $_SESSION['siglas'] = $data['siglas'];
                $_SESSION['departamento'] = $data['departamento'];
                $_SESSION['rango'] = $data['rango'];
                $_SESSION['cargo'] = $data['cargo'];
                $_SESSION['ult_hora'] = $data['ult_hora'];
                $_SESSION['ult_fecha'] = $data['ult_fecha'];
                
                $permisosDelUsuario = $bd->query("SELECT * FROM permisos WHERE cargo_id = ".$data["cargo_id"]);

                while ($row = $permisosDelUsuario->fetch_assoc()) {
                    $_SESSION[$row["accion"]] = $row["accion"];
                }

                $bd->query("UPDATE usuario SET alerta_sospechosa = false WHERE email = '".$data["email"]."'");
                echo "ok";
            } else{
                echo "Su usuario se encuentra suspendido";
            }
        } else {
            if($data['alerta_sospechosa']){
                $asunto = "Corpotulipa - Alerta de ingreso sospechoso en su cuenta";
                include("email/enviar-mail.php");
                $sendMail = sendMail($email,$asunto,0,0,0);
            }
            $bd->query("UPDATE usuario SET alerta_sospechosa = true WHERE email = '".$data["email"]."'");
            echo "Clave inv??lida";
        }
    } else {
        echo "Usuario inv??lido";
    }
} else {
    echo "Debe ingresar todos los datos correctamente";
}
} else {
    header("Location: ../404");
}