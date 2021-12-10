<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Usuarios</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: 404");
    ?>  
    <form id="form">
        <input type="text" name="nombre" id="nombre" value="<?php echo $_SESSION['nombre']?>">
        <input type="text" name="apellido" id="apellido" value="<?php echo $_SESSION['apellido']?>">
        <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']?>">
        <label for="masculino">Masculino</label>
        <input type="radio" name="genero" id="masculino" value="Masculino" onclick="s(1)" <?php if($_SESSION['genero'] == 'Masculino') echo "checked"?>>
        <label for="femenino">Femenino</label>
        <input type="radio" name="genero" id="femenino" value="Femenino" onclick="s(1)" <?php if($_SESSION['genero'] == 'Femenino') echo "checked"?>>
        <label for="otro">Otro</label>
        <input type="radio" name="genero" id="otro" value="Otro" onclick="s(2)" <?php if($_SESSION['genero'] != 'Masculino' && $_SESSION['genero'] != 'Femenino') echo "checked"?>>
        <input type="text" name="other" id="other" <?php if($_SESSION['genero'] != 'Masculino' && $_SESSION['genero'] != 'Femenino') echo "value='".$_SESSION['genero']."'"; else echo "disabled";?>>
        <input type="date" name="nacimiento" id="nacimiento" value="<?php echo $_SESSION['birthday']?>">
        <input type="file" name="img" id="img">
        <button type="submit">send</button>
        <img width="300px" height="300px" src="<?php echo $_SESSION['img'] ?>" alt="" id="image"> 
    </form>
    <br><br><br><br><br><br><br><br><br><br>
    <form id="form2">
        <input type="password" name="old" id="old">
        <input type="password" name="new" id="new">
        <input type="password" name="confirm" id="confirm">
        <button type="submit">Cambiar</button>
    </form>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        function s(i){
            if(i==1){
                document.getElementById("other").disabled = true
                document.getElementById("other").value = ""
            }
            else
                document.getElementById("other").disabled = false
        }

        $('#form').submit(function(e) {
            var formData = new FormData(document.getElementById("form"));
            formData.append('img', $('#img')[0].files[0]);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'editar_perfil',
                data: formData,
                enctype:'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href=""
                    } else {
                        alert(response)
                    }
                }
            });
        });

        $('#form2').submit(function(e) {
            var formData = new FormData(document.getElementById("form2"));
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'password',
                data: formData,
                enctype:'application/x-www-form-urlencoded',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function(response)
                {
                    if(response=="ok"){
                        alert("Su contraseña ha sido modificada")
                        location.href="logout"
                    } else if(response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href = ""
                    } else {
                        alert(response)
                    }
                }
            });
        });

        const $seleccionArchivos = document.querySelector("#img"),
            $imagenPrevisualizacion = document.querySelector("#image");

            // Escuchar cuando cambie
            $seleccionArchivos.addEventListener("change", () => {
            // Los archivos seleccionados, pueden ser muchos o uno
            const archivos = $seleccionArchivos.files;
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
                $imagenPrevisualizacion.src = "";
                return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            const primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            $imagenPrevisualizacion.src = objectURL;
            });
    </script>    
</body>
</html>