<?php
if(isset($router)){
$username = trim(addslashes($_POST['username']));
$password = trim(addslashes($_POST['password']));

if($username != "" && $password != ""){
    include("bd.php");
    $sql = "SELECT * FROM usuario INNER JOIN perfil ON usuario.id = perfil.id_usuario LEFT JOIN cargo ON perfil.cargo_id = cargo.cargo_id LEFT JOIN departamento ON perfil.departamento_id = departamento.departamento_id WHERE username = '$username'";
    $proceso = $bd->query($sql);
    if($data = $proceso->fetch_assoc()){
        if(password_verify($password, $data['password'])){
            if($data['status'] == "active"){
                $_SESSION['id'] = $data['id'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['apellido'] = $data['apellido'];
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
                echo "ok";
            } else{
                echo "Su usuario se encuentra suspendido";
            }
        } else {
            echo "Clave inválida";
        }
    } else {
        echo "Usuario inválido";
    }
} else {
    echo "Debe ingresar todos los datos correctamente";
}
} else {
    header("Location: ../404");
}