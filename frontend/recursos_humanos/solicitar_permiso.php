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
        <h4>Tipo</h4>
        <label for="academico">Academico</label>
        <input type="radio" name="motivo" id="academico" value="Académico">
        <label for="salud">Salud</label>
        <input type="radio" name="motivo" id="salud" value="Salud">
        <label for="personal">Asunto Personal</label>
        <input type="radio" name="motivo" id="personal" value="Asunto Personal">
        <label for="legal">Trámite Legal</label>
        <input type="radio" name="motivo" id="legal" value="Trámite Legal">
        <label for="familiar">Fallecimiento Familiar</label>
        <input type="radio" name="motivo" id="familiar" value="Fallecimiento Familiar">
        <label for="siniestro">Siniestro</label>
        <input type="radio" name="motivo" id="siniestro" value="Siniestro">
        <label for="matrimonio">Matrimonio</label>
        <input type="radio" name="motivo" id="matrimonio" value="Matrimonio">
        <select name="responsable">
            <?php
            while ($r = $responsables->fetch_assoc()) {
                echo "<option value='" . $r["id"] . "'>" . $r["apellido"] . " " . $r["nombre"] . "</option>";
            }
            ?>
        </select>
        <input type="date" name="inicio">
        <input type="date" name="fin">
        <textarea name="descripcion"></textarea>
        <input type="text" name="clave" placeholder="Clave">
        <button type="submit">Enviar</button>
    </form>

    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'solicitud_permiso',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                        location.href = "sesion";
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>

</html>