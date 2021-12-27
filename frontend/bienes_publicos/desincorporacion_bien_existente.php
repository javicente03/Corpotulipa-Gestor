<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Inventario</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");   
    ?>
    
    <h4>Nombre del bien: <?php echo $bien["nombre_bien"] ?></h4>
    <h4>Código: <?php echo $bien["codigo"] ?></h4>
    <h4>Nombre del Responsable: <?php echo $bien["nombre"]." ".$bien["apellido"] ?></h4>
    <h4>Departamento: <?php echo $bien["departamento"] ?></h4>
    <h4>Sede: <?php echo $bien["sede"] ?></h4>
    
    <form id="form">
        <textarea name="motivo" placeholder="Motivo"></textarea>
        <input type="text" name="clave" placeholder="Ingrese su clave de seguridad">
        <input type="file" name="img1" id="img1">
        <input type="file" name="img2" id="img2">
        <button type="submit">Enviar</button>
        <input type="hidden" name="bien" value="<?php echo $bien["id_bien"] ?>">
    </form>
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            var formData = new FormData(document.getElementById("form"));
            formData.append('img1', $('#img1')[0].files[0]);
            formData.append('img2', $('#img2')[0].files[0]);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'desincorporar_bienes',
                data: formData,
                enctype:'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href = "../desincorporar_bienes";
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>
</html>