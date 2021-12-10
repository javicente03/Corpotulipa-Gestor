<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Prestamo de Muebles e Inmuebles</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        <input type="text" placeholder="Realice su búsqueda" name="bien" id="bien">
        <button type="submit">Enviar</button>
    </form>
    <div>
        <table>
            <thead>
                <th>Código</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Responsable</th>
                <th>Departamento</th>
                <th>Solicitar</th>
            </thead>
            <tbody id="bienes">

            </tbody>
        </table>
    </div>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'buscar_bien',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    document.getElementById("bienes").innerHTML = response
                }
            });
        });
    </script>
</body>
</html>