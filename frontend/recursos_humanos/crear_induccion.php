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
        <input type="text" placeholder="Clave" name="clave" required>
        <input type="date" name="fecha" required>
        <select name="responsable">
            <?php
            while ($r = $responsables->fetch_assoc()) {
                echo "<option value='" . $r["id"] . "'>" . $r["apellido"] . " " . $r["nombre"] . "</option>";
            }
            ?>
        </select>
        <button type="submit">Enviar</button>
    </form>
    <?php
    foreach ($array as $key => $value) { ?>
        <input type="checkbox" id="user<?php echo $value["id"] ?>" onclick="marcado(<?php echo $value['id'] ?>)">
        <label for="user<?php echo $value["id"] ?>"><?php echo $value["nombre"] ?></label>
    <?php
    }
    ?>

    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        var array = Array()
        console.log(array)

        function marcado(id) {
            if (document.getElementById("user" + id).checked)
                array.push(id)
            else {
                var pos = array.indexOf(id)
                array.splice(pos, 1)
            }
        }

        $('#form').submit(function(e) {
            var formData = new FormData(document.getElementById("form"));
            formData.append('array', JSON.stringify(array));
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'charla_induccion',
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
        });
    </script>
</body>

</html>