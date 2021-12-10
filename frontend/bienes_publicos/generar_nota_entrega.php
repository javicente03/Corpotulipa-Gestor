<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Incorporación de Muebles e Inmuebles</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        <h3><?php echo $bien["nombre_bien"] ?></h3>
        <h3><?php echo $bien["siglas"] ?></h3>

        <!-- Llenar la pantalla con mas datos -->
        <label for="">Revisado Por:</label>
        <select name="revisado" id="revisado">
            <?php
                while ($usuario = $usuarios->fetch_assoc()) {
                    echo "<option value='".$usuario['id']."'>".$usuario['nombre']."</option>";
                }
            ?>
        </select>
        <label for="">Verificado Por:</label>
        <select name="verificado" id="verificado">
            <?php
                while ($usuario = $usuarios2->fetch_assoc()) {
                    echo "<option value='".$usuario['id']."'>".$usuario['nombre']."</option>";
                }
            ?>
        </select>
        <label for="">Validado Por:</label>
        <select name="validado" id="validado">
            <?php
                while ($usuario = $usuarios3->fetch_assoc()) {
                    echo "<option value='".$usuario['id']."'>".$usuario['nombre']."</option>";
                }
            ?>
        </select>
        <input type="hidden" name="incorporacion" value="<?php echo $bien["id_bien"] ?>">
        <button type="submit">Enviar</button>
    </form>

    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'generar_nota_entrega',
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