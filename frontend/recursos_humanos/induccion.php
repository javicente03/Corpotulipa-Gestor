<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Recursos Humanos</title>
</head>

<body>
    <?php
    if (!isset($router))
        header("Location: ../404");
    if($induccion["fecha_respuesta"] == null){
    ?>
    <form id="form">
        <input type="checkbox" name="cuadernillo" id="cuadernillo">
        <label for="cuadernillo">Cuadernillo de bienvenida</label>
        <input type="checkbox" name="descripcion" id="descripcion">
        <label for="descripcion">Descripción del cargo</label>
        <input type="checkbox" name="politica" id="politica">
        <label for="politica">Política de Cálidad</label>
        <input type="text" placeholder="Clave" name="clave">
        <button type="submit">Enviar</button>
    </form>
    <?php 
    } else
        echo "Ya este test fue respondido";
    ?>

    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'charla_induccion',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                        location.href = "../sesion";
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>

</html>