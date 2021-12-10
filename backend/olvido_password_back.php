<?php
if(isset($router)){
    $email = trim(addslashes($_POST['email']));
    if($email != ""){
        include("validaciones.php");
        $validar = validar_email($email);
        if($validar){
            include("bd.php");
            $sql = "SELECT * FROM usuario WHERE email = '$email'";
            $proceso = $bd->query($sql);
            if($data = $proceso->fetch_assoc()){
                $hoy = date('Y-m-d');
                $code = bin2hex(random_bytes(5));
                $id = $data['id'];
                $borra = "DELETE FROM reset_password WHERE user_reset = $id";
                $borrar = $bd->query($borra);
                $sql1 = "INSERT INTO reset_password (user_reset,token,fecha_reset) VALUES ('$id','$code','$hoy')";
                $proceso1 = $bd->query($sql1);
                $asunto = "Corpotulipa Resetee su contrasena";
                include("email/enviar-mail.php");
                $sendMail = sendMail($email,$asunto,0,0,0,$code);
                if($sendMail)
                    echo "ok";
            } else {
                echo "Correo no registrado";
            }
        } else {
            echo "Ingrese un correo Gmail válido";
        }
    } else {
        echo "Debe ingresar un email";
    }   
} else {
    header("Location: ../404");
}