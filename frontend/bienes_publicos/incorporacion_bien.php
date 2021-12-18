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
        <label for="optM">Mueble</label>
        <input type="radio" name="tipo" id="optM" value="Mueble">
        <label for="optI">Inmueble</label>
        <input type="radio" name="tipo" id="optI" value="Inmueble">

        <input type="text" placeholder="Organismo" id="organismo" name="organismo">
        <input type="text" placeholder="Denominación" id="denoOrga" name="denoOrga">
        <select name="departamento" id="departamento">
            <?php
            while ($departamento = $departamentos->fetch_assoc()) {
                $id = $departamento["departamento_id"];
                echo "<option value='$id'>".$departamento['siglas']."</option>";
            }
            ?>            
        </select>
        <input type="text" placeholder="Denominación" id="denoDepa" name="denoDepa">
        <input type="text" placeholder="Dependencia Usuaria" id="dependencia" name="dependencia">
        <input type="text" placeholder="Denominación" id="denoUsu"  name="denoUsu">
        <input type="number" placeholder="Valor Unitario" id="valor" name="valor">



        <!-- Muebles -->
        <input type="text" placeholder="Concepto del Movimiento" id="concepto" name="concepto">
        <input type="text" placeholder="Nombre del bien" id="mueble" name="mueble">
        <textarea placeholder="Descripción" id="descripcion" name="descripcion"></textarea>

        <!-- INMUEBLES -->
        <input type="number" id="catastro" placeholder="Número de Catastro" name="catastro">
        <input type="text" placeholder="Nombre del Inmueble" id="inmueble" name="inmueble">

        <select name="responsable" id="responsable">
            <?php
            while ($usuario = $usuarios->fetch_assoc()) {
                $id = $usuario["id"];
                echo "<option value='$id'>".$usuario['nombre']." ".$usuario['apellido']."</option>";
            }
            ?>            
        </select>

        <button type="submit">Enviar</button>
    </form>

    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'incorporar_bien',
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