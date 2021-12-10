<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Departamentos</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        <input type="text" name="siglas" id="siglas" value="<?php echo $siglas ?>">
        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>">
        <input type="hidden" name="id" value="<?php echo $data['departamento_id'] ?>">
        <button type="submit" >Editar</button>        
    </form>


    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'editar_departamento',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok"){
                        location.href = "../departamentos"
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>    
</body>
</html>