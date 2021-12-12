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
        <input type="hidden" name="analista" value="a">
        <input type="hidden" name="prestamo" value="<?php echo $prestamo["id_prestamo_bien"] ?>">
        <input type="hidden" name="nombre_bien" value="<?php echo $responsable["nombre_bien"] ?>">
        <input type="hidden" name="bien" value="<?php echo $responsable["id_bien"] ?>">
        <input type="hidden" name="solicitante" value="<?php echo $prestamo["solicitante"] ?>">
        <input type="hidden" name="solicitante_nombre" value="<?php echo $prestamo["nombre"]." ".$prestamo["apellido"] ?>">
        <input type="hidden" name="responsable" value="<?php echo $responsable["responsable"] ?>">
        <input type="hidden" name="responsable_nombre" value="<?php echo $responsable["nombre"]." ".$responsable["apellido"] ?>">
        <label for="interno">Interno</label>
        <input type="radio" name="tipo" id="interno" value="Interno">
        <label for="externo">Externo</label>
        <input type="radio" name="tipo" id="externo" value="Externo">
        <h4><?php echo $responsable["nombre_bien"] ?></h4>
        <h4><?php echo $responsable["descripcion"] ?></h4>
        <h4><?php echo $responsable["codigo"] ?></h4>
        <h4>Solicitante: <?php echo $prestamo["nombre"]." ".$prestamo["apellido"] ?></h4>
        <h4>Solicitante:<?php echo $prestamo["siglas"] ?></h4>
        <h4>Responsable: <?php echo $responsable["nombre"]." ".$responsable["apellido"] ?></h4>
        <h4>Responsable: <?php echo $responsable["siglas"] ?></h4>
        <h4>Duración: <?php echo $prestamo["duracion"] ?></h4>
        <h4>Concepto:</h4>
        <label for="Prestamo">Prestamo</label>
        <input type="radio" name="concepto" id="Prestamo" value="Prestamo">
        <label for="Traslado">Traslado</label>
        <input type="radio" name="concepto" id="Traslado" value="Traslado">
        <label for="Mantenimiento">Mantenimiento</label>
        <input type="radio" name="concepto" id="Mantenimiento" value="Mantenimiento">
        <label for="Garantia">Garantía</label>
        <input type="radio" name="concepto" id="Garantia" value="Garantia">
        <label for="Reparacion">Reparación</label>
        <input type="radio" name="concepto" id="Reparacion" value="Reparacion">
        <label for="Cambio">Cambio</label>
        <input type="radio" name="concepto" id="Cambio" value="Cambio">
        <select name="coordinador" id="">
        <?php
            while ($usuario = $usuarios->fetch_assoc()) {
        ?>
            <option value="<?php echo $usuario["id"]?>"><?php echo $usuario["nombre"]." ".$usuario["apellido"]." | ".$usuario["cargo"] ?></option>
        <?php
            }
        ?>
        </select>
        <input type="password" name="clave" placeholder="Ingrese su clave de seguridad">
        <input type="text" name="razon">
        <input type="text" name="rif">
        <input type="text" name="direccion">
        <input type="text" name="nombre_responsable">
        <input type="text" name="telefono_fijo">
        <input type="text" name="telefono_contacto">
        <button type="submit">Enviar</button>
    </form>
   
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'movimiento_bienes',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href = "../movimiento_bienes";
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>
</html>