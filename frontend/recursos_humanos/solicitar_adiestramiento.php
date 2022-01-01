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
    <form id="form">
        <h4>Método de desarrollo de competencia</h4>
        <label for="curso">Curso</label>
        <input type="radio" name="metodo" id="curso" value="Curso">
        <label for="taller">Taller</label>
        <input type="radio" name="metodo" id="taller" value="Taller">
        <label for="congreso">Congreso</label>
        <input type="radio" name="metodo" id="congreso" value="Congreso">
        <label for="foro">Foro</label>
        <input type="radio" name="metodo" id="foro" value="Foro">
        <label for="otros">Otros</label>
        <input type="radio" name="metodo" id="otros" value="Otros">
        <input type="text" placeholder="Denominación" name="denominacion">
        <?php
        while ($participante = $participantes->fetch_assoc()) { ?>
            <input type="checkbox" id="user<?php echo $participante["id"] ?>" onclick="marcado(<?php echo $participante['id'] ?>)">
            <label for="user<?php echo $participante["id"] ?>"><?php echo $participante["nombre"] ?></label>
            <label for="c<?php echo $participante["id"] ?>">Conoce</label>
            <input type="radio" name="nivel1<?php echo $participante["id"] ?>" id="c<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante['id'] ?>,"Conoce")>
            <label for="a<?php echo $participante["id"] ?>">Aplica</label>
            <input type="radio" name="nivel1<?php echo $participante["id"] ?>" id="a<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante["id"] ?>,"Aplica")>
            <label for="d<?php echo $participante["id"] ?>">Domina</label>
            <input type="radio" name="nivel1<?php echo $participante["id"] ?>" id="d<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante["id"] ?>,"Domina")>
            <label for="av<?php echo $participante["id"] ?>">Avanzado</label>
            <input type="radio" name="nivel1<?php echo $participante["id"] ?>" id="av<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante["id"] ?>,"Avanzado")>
            <label for="e<?php echo $participante["id"] ?>">Experto</label>
            <input type="radio" name="nivel1<?php echo $participante["id"] ?>" id="e<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante["id"] ?>,"Experto")>
            <label for="c1<?php echo $participante["id"] ?>">Conoce</label>
            <input type="radio" name="nivel2<?php echo $participante["id"] ?>" id="c1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Conoce")>
            <label for="a1<?php echo $participante["id"] ?>">Aplica</label>
            <input type="radio" name="nivel2<?php echo $participante["id"] ?>" id="a1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Aplica")>
            <label for="d1<?php echo $participante["id"] ?>">Domina</label>
            <input type="radio" name="nivel2<?php echo $participante["id"] ?>" id="d1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Domina")>
            <label for="av1<?php echo $participante["id"] ?>">Avanzado</label>
            <input type="radio" name="nivel2<?php echo $participante["id"] ?>" id="av1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Avanzado")>
            <label for="e1<?php echo $participante["id"] ?>">Experto</label>
            <input type="radio" name="nivel2<?php echo $participante["id"] ?>" id="e1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Experto")>
        <?php
        }
        ?>
        <input type="text" name="meta" placeholder="Meta Asociada">

        <input type="text" name="area" placeholder="Área de Conocimiento">
        <input type="text" name="clave" placeholder="Clave">
        <button type="submit">Enviar</button>
    </form>

    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        var json = Array()

        function marcado(id) {
            if ($("#user" + id).prop('checked')) {
                var requerido = "",
                    actual = "";
                if ($("#c" + id).prop('checked'))
                    requerido = "Conoce"
                else if ($("#a" + id).prop('checked'))
                    requerido = "Aplica"
                else if ($("#d" + id).prop('checked'))
                    requerido = "Domina"
                else if ($("#av" + id).prop('checked'))
                    requerido = "Avanzado"
                else if ($("#e" + id).prop('checked'))
                    requerido = "Experto"
                if ($("#c1" + id).prop('checked'))
                    actual = "Conoce"
                else if ($("#a1" + id).prop('checked'))
                    actual = "Aplica"
                else if ($("#d1" + id).prop('checked'))
                    actual = "Domina"
                else if ($("#av1" + id).prop('checked'))
                    actual = "Avanzado"
                else if ($("#e1" + id).prop('checked'))
                    actual = "Experto"

                if (requerido != "" && actual != "") {
                    json.push([id, requerido, actual])
                } else {
                    alert("Debe seleccionar el nivel requerido y actual del empleado")
                    $("#user" + id).prop('checked', false)
                }
            } else {
                var pos = json.indexOf(id)
                json.splice(pos, 1)
            }
        }

        function requerido(id, nivel) {
            json.forEach(element => {
                if (element[0] == id) {
                    element[1] = nivel
                }
            });
        }

        function actual(id, nivel) {
            json.forEach(element => {
                if (element[0] == id) {
                    element[2] = nivel
                }
            });
        }



        $('#form').submit(function(e) {
            if (json.length > 0) {
                var formData = new FormData(document.getElementById("form"));
                formData.append('array', JSON.stringify(json));
                $.ajax({
                    type: "POST",
                    url: 'solicitud_adiestramiento',
                    data: formData,
                    enctype: 'application/x-www-form-urlencoded',
                    processData: false, // tell jQuery not to process the data
                    contentType: false,
                    success: function(response) {
                        if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                            location.href = "";
                        } else {
                            alert(response)
                        }
                    }
                });
            } else {
                alert("Debe añadir algún participante")
            }
            e.preventDefault();
        });
    </script>
</body>

</html>