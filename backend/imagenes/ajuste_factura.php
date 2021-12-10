<?php
if(isset($router)){

//Función para subir la imagen del perfil del usuario
function subir_imagen($tipo,$imagen,$nombre)
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
		$img_reajustada = imagecreatetruecolor(500,500);

			//Creo una imagen basada en la original, dependiendo de su extension es el tipo que creare
			switch($extension)
			{
				case ".jpg":
					$img_original = imagecreatefromjpeg($imagen);
					//Reajusto la imagen nueva con respecto a la original
					imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, 500, 500, $ancho_img, $alto_img);
					//Guardo la imagen reescalada en el servidor
					$nombre_img_ext = "frontend/img/facturas_cc/".$nombre.$extension;
					$nombre_img = "frontend/img/facturas_cc/".$nombre;
					imagejpeg($img_reajustada,$nombre_img_ext,100);
                    break;
                case ".gif":
					$img_original = imagecreatefromgif($imagen);
					//Reajusto la imagen nueva con respecto a la original
					imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, 500, 500, $ancho_img, $alto_img);
					//Guardo la imagen reescalada en el servidor
					$nombre_img_ext = "frontend/img/facturas_cc/".$nombre.$extension;
					$nombre_img = "frontend/img/facturas_cc/".$nombre;
					imagegif($img_reajustada,$nombre_img_ext);
                    break;
                case ".png":
					$img_original = imagecreatefrompng($imagen);
					//Reajusto la imagen nueva con respecto a la original
					imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, 500, 500, $ancho_img, $alto_img);
					//Guardo la imagen reescalada en el servidor
					$nombre_img_ext = "frontend/img/facturas_cc/".$nombre.$extension;
					$nombre_img = "frontend/img/facturas_cc/".$nombre;
					imagepng($img_reajustada,$nombre_img_ext,0);
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