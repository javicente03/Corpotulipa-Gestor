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

        if(!$ultimo["aprobado"] && !$ultimo["rechazado"]){
    ?>

    <form id="form">
        <label for="aprobar">Aprobar</label>
        <input type="radio" name="accion" id="aprobar" value="Aprobar">
        <label for="rechazar">Rechazar</label>
        <input type="radio" name="accion" id="rechazar" value="Rechazar">
        <input type="text" name="clave" placeholder="Ingrese su clave de seguridad">
        <textarea name="motivo" placeholder="Motivo"></textarea>
        <button type="submit">Enviar</button>
    </form>
    <?php } else
        echo "No puede solicitar, hay una en proceso";
    
    ?>
   
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'aprobar_inventario',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href = "";
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>
</html>