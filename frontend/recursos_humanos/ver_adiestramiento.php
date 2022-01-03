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
    ?>
    <table>
        <thead>
            <th>Nivel Actual</th>
            <th>Nivel Requerido</th>
            <th>Fecha</th>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $participante["nivel_actual"] ?></td>
                <td><?php echo $participante["nivel_requerido"] ?></td>
                <td><?php echo $participante["fecha_adiestramiento"] ?></td>
            </tr>
        </tbody>
    </table>
    <?php
        $hoy = date("Y-m-d");
        if($hoy > $participante["fecha_adiestramiento"]){
    ?>
        <form id="form">
            <h5>¿En qué medida fue útil y aplicable para su cargo la experiencia
                    adquirida en el adiestramiento?</h5>
            <label for="primera1">Poco</label><input type="radio" name="primera" id="primera1" value="Poco">
            <label for="primera2">Moderado</label><input type="radio" name="primera" id="primera2" value="Moderado">
            <label for="primera3">Mucho</label><input type="radio" name="primera" id="primera3" value="Mucho">

            <h5>¿El contenido del curso cumplió con sus expectativas?</h5>
            <label for="segunda1">Poco</label><input type="radio" name="segunda" id="segunda1" value="Poco">
            <label for="segunda2">Moderado</label><input type="radio" name="segunda" id="segunda2" value="Moderado">
            <label for="segunda3">Mucho</label><input type="radio" name="segunda" id="segunda3" value="Mucho">

            <h5 for="primera">¿El Facilitador tuvo habilidad para transmitir conocimientos y aclarar
                    dudas?</h5>
            <label for="tercera1">Poco</label><input type="radio" name="tercera" id="tercera1" value="Poco">
            <label for="tercera2">Moderado</label><input type="radio" name="tercera" id="tercera2" value="Moderado">
            <label for="tercera3">Mucho</label><input type="radio" name="tercera" id="tercera3" value="Mucho">


            <h5>¿Como considera que fue la organización del adiestramiento?</h5>
            <label for="cuarta1">Malo</label><input type="radio" name="cuarta" id="cuarta1" value="Malo">
            <label for="cuarta2">Regular</label><input type="radio" name="cuarta" id="cuarta2" value="Regular">
            <label for="cuarta3">Bueno</label><input type="radio" name="cuarta" id="cuarta3" value="Bueno">
            
            <h5>¿Cómo califica el ambiente en el cual se desarrollo el adiestramiento?</h5>
            <label for="quinta1">Malo</label><input type="radio" name="quinta" id="quinta1" value="Malo">
            <label for="quinta2">Regular</label><input type="radio" name="quinta" id="quinta2" value="Regular">
            <label for="quinta3">Bueno</label><input type="radio" name="quinta" id="quinta3" value="Bueno">
            
            <h5>¿Cómo califica el material de apoyo suministrado?</h5>
            <label for="sexta1">Malo</label><input type="radio" name="sexta" id="sexta1" value="Malo">
            <label for="sexta2">Regular</label><input type="radio" name="sexta" id="sexta2" value="Regular">
            <label for="sexta3">Bueno</label><input type="radio" name="sexta" id="sexta3" value="Bueno">
            
            <h5 for="primera">¿Cómo califica el facilitador, ponente o instructor al motivar al grupo?</h5>
            <label for="septima1">Malo</label><input type="radio" name="septima" id="septima1" value="Malo">
            <label for="septima2">Regular</label><input type="radio" name="septima" id="septima2" value="Regular">
            <label for="septima3">Bueno</label><input type="radio" name="septima" id="septima3" value="Bueno">
            
            <textarea name="conocimientos" placeholder="Conocimientos Adquiridos"></textarea>
            <textarea name="recomendaciones" placeholder="Recomendaciones"></textarea>
            <button type="submit">Enviar</button>
            <input type="hidden" name="adiestramiento" value="<?php echo $participante["id_adiestramiento"] ?>">
        </form>
    <?php
        }
    ?>
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'ver_adiestramiento',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
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