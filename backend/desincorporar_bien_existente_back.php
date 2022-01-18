<?php
if(isset($router)){
    $clave = trim(addslashes($_POST["clave"]));
    if($clave != ""){
        include("bd.php");
        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $motivo = trim(addslashes($_POST["motivo"]));
            if($motivo != "" && strlen($motivo) <= 5000){
                if(strstr($_FILES["img1"]["type"],"image") && strstr($_FILES["img2"]["type"],"image")){
                    $bien = ($bd->query("SELECT * FROM bienes_publicos WHERE id_bien = ".$_POST["bien"]))->fetch_assoc();
                    if($bien){
                        if(strstr($_FILES["img1"]["type"],"jpeg"))
                            $extension = ".jpg";
                        else if(strstr($_FILES["img1"]["type"],"gif"))
                            $extension = ".gif";
                        else if(strstr($_FILES["img1"]["type"],"png"))
                            $extension = ".png";
                        $tmp1 = $_FILES["img1"]["tmp_name"];
                        $name1 = "frontend/img/bienes/bien_".$_POST["bien"]."_1".$extension;

                        if(strstr($_FILES["img2"]["type"],"jpeg"))
                            $extension2 = ".jpg";
                        else if(strstr($_FILES["img2"]["type"],"gif"))
                            $extension2 = ".gif";
                        else if(strstr($_FILES["img2"]["type"],"png"))
                            $extension2 = ".png";
                        $tmp2 = $_FILES["img2"]["tmp_name"];
                        $name2 = "frontend/img/bienes/bien_".$_POST["bien"]."_2".$extension2;

                        if(move_uploaded_file($tmp1,$name1) 
                            && move_uploaded_file($tmp2,$name2)){
                            
                            $bd->query("INSERT INTO reporte_bien (id_bien,motivo_reporte,descripcion_reporte,reporte_tramitado,img1,img2) 
                            VALUES ('".$bien["id_bien"]."','Desuso','$motivo',true,'$name1','$name2')");

                            echo "ok";
                        } else
                            echo "Error al subir los archivos";    
                    } else
                        echo "Bien Mueble no encontrado";
                    
                } else 
                    echo "Solo debe subir imágenes";
            } else
                echo "Debe ingresar un motivo y este no debe exceder los 5000 caracteres";
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar su clave de seguridad";
} else
    header("Location: ../404");