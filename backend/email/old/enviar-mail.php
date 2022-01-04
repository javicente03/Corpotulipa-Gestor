<?php
function sendMail($para,$asunto,$nombre,$apellido,$password){

if($asunto == "Bienvenido a Corpotulipa"){
	$mensaje = "<div style='background-color: rgb(26, 23, 23); width: 250px; padding: 0px; border-radius: .5em; height: 550px;'>
<h1 style='color: rgb(250, 225, 112); font-size: 2em; text-align: center;'>Bienvenido a Corpotulipa</h1>
<h1 style='color: rgb(250, 225, 112); text-align: center;' margin-left: 80px;'>".$nombre." ".$apellido."</h1>
<p style='color: rgb(250, 225, 112); text-align: center;'>Contraseña: ".$password."</p>
<a href='' style='background-color: rgb(250, 225, 112); color: black; padding: 10px; border-radius: .5em; margin-left: 80px; text-decoration: none; font-weight: bold; position: absolute;'>Ingresa Aquí</a>
</div>";
} else if($asunto == "Corpotulipa Resetee su contrasena"){
	$mensaje = "<div style='background-color: rgb(26, 23, 23); width: 250px; padding: 0px; border-radius: .5em; height: 550px;'>
	<h1 style='color: rgb(250, 225, 112); font-size: 2em; text-align: center;'>Resetee su contraseña</h1>
	<p style='color: rgb(250, 225, 112); text-align: center;'>Copie este código y peguelo en el siguiente enlace: ".$password."</p>
	<a href='localhost/corpotulipa-gestion/resetear_password' style='background-color: rgb(250, 225, 112); color: black; padding: 10px; border-radius: .5em; margin-left: 80px; text-decoration: none; font-weight: bold; position: absolute;'>Ingresa Aquí</a>
	</div>";
}


	include_once("class.phpmailer.php");
	include_once("class.smtp.php");
	
	$mail = new PHPMailer(); //creo un objeto de tipo PHPMailer
	$mail->IsSMTP(); //protocolo SMTP
	$mail->SMTPAuth = true;//autenticación en el SMTP
	$mail->SMTPSecure = "ssl";//SSL security socket layer
	$mail->Host = "smtp.gmail.com";//servidor de SMTP de gmail
	$mail->Port = 465;//puerto seguro del servidor SMTP de gmail
	$mail->From = "javier"; //Remitente del correo
	$mail->AddAddress($para);// Destinatario
	$mail->Username = "javicentego@gmail.com";//Aqui pon tu correo de gmail
	$mail->Password = "javileon03*";//Aqui pon tu contraseña de gmail
	$mail->Subject = $asunto; //Asunto del correo
	$mail->Body = $mensaje; //Contenido del correo
	$mail->WordWrap = 50; //No. de columnas
	$mail->MsgHTML($mensaje);//Se indica que el cuerpo del correo tendrá formato html
	
	if($mail->Send()){ //enviamos el correo por PHPMailer
		// $respuesta = "El mensaje ha sido enviado con la clase PHPMailer y tu cuenta de gmail =)";
		// return $respuesta;
		return true;
	} else{
		return false; 
	}
}