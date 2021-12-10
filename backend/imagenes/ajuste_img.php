<?php
if(isset($router)){
//El parametro de $extension determina que tipo de imagen no se borrará por ejemplo si es jpg significa que la imagen con extensión .jpg se queda en el servidor y si existen imagenes con el mismo nombre pero con extension png o gif se eliminaran, con esta función evito tener imagenes duplicadas con distinta extensiones para cada perfil la funcion file_exists evalua si un archivo existe y la funcion unlink borra un archivo del servidor
function borrar_imagenes($ruta,$extension)
{
	switch($extension){
		case ".jpg":
			if(file_exists($ruta.".png"))
				unlink($ruta.".png");
			if(file_exists($ruta.".gif"))
				unlink($ruta.".gif");
			break;
		case ".gif":
			if(file_exists($ruta.".png"))
				unlink($ruta.".png");
			if(file_exists($ruta.".jpg"))
				unlink($ruta.".jpg");
			break;
		case ".png":
			if(file_exists($ruta.".jpg"))
				unlink($ruta.".jpg");
			if(file_exists($ruta.".gif"))
				unlink($ruta.".gif");
			break;
	}
}

//Función para subir la imagen del perfil del usuario
function subir_imagen($tipo,$imagen,$username)
{
	//strstr($cadena1,$cadena2) sirve para evaluar si en la primer cadena de texto existe la segunda cadena de texto
	//Si dentro del tipo del archivo se encuentra la palabra image significa que el archivo es una imagen
	if(strstr($tipo,"image"))
	{
		//para saber de que tipo de extension es la imagen
		if(strstr($tipo,"jpeg"))
			$extension = ".jpg";
		else if(strstr($tipo,"gif"))
			$extension = ".gif";
		else if(strstr($tipo,"png"))
			$extension = ".png";

		//para saber si la imagen tiene el ancho correcto que es de 420px
		
		
		
        $tam_img = getimagesize($imagen);
		$ancho_img = $tam_img[0];
		$alto_img = $tam_img[1];

		//Creo una imagen en color real con las nuevas dimensiones  
		$img_reajustada = imagecreatetruecolor(300,300);

			//Creo una imagen basada en la original, dependiendo de su extension es el tipo que creare
			switch($extension)
			{
				case ".jpg":
					$img_original = imagecreatefromjpeg($imagen);
					//Reajusto la imagen nueva con respecto a la original
					imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, 300, 300, $ancho_img, $alto_img);
					//Guardo la imagen reescalada en el servidor
					$nombre_img_ext = "frontend/img/profile/".$username.$extension;
					$nombre_img = "frontend/img/profile/".$username;
					imagejpeg($img_reajustada,$nombre_img_ext,100);
					//Ejecuto la funcion para borrar posibles imagenes dobles para el perfil
                    borrar_imagenes($nombre_img,".jpg");
                    break;
                case ".gif":
					$img_original = imagecreatefromgif($imagen);
					//Reajusto la imagen nueva con respecto a la original
					imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, 300, 300, $ancho_img, $alto_img);
					//Guardo la imagen reescalada en el servidor
					$nombre_img_ext = "frontend/img/profile/".$username.$extension;
					$nombre_img = "frontend/img/profile/".$username;
					imagegif($img_reajustada,$nombre_img_ext);
					//Ejecuto la funcion para borrar posibles imagenes dobles para el perfil
                    borrar_imagenes($nombre_img,".gif");
                    break;
                case ".png":
					$img_original = imagecreatefrompng($imagen);
					//Reajusto la imagen nueva con respecto a la original
					imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, 300, 300, $ancho_img, $alto_img);
					//Guardo la imagen reescalada en el servidor
					$nombre_img_ext = "frontend/img/profile/".$username.$extension;
					$nombre_img = "frontend/img/profile/".$username;
					imagepng($img_reajustada,$nombre_img_ext,0);
					//Ejecuto la funcion para borrar posibles imagenes dobles para el perfil
                    borrar_imagenes($nombre_img,".png");
                    break;
			}
		

		//Asigno el nombre de la foto que se guardará en la BD como cadena de texto
        // $imagen=$username.$extension;
        return $extension;
	}
	else
	{
		return false;
	}
}
}