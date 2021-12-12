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
        $date = date("Y-m-d");
        $tramite = date_create($prestamo["fecha_tramite"]);
        $date = date_create($date);
        $interval = date_diff($tramite, $date);
        $transcurridos = $interval->format('%a');
        $restante = $prestamo["duracion"] - $transcurridos;
    ?>
    <h4>Nombre del bien: <?php echo $prestamo["nombre_bien"] ?></h4>
    <h4>Motivo: <?php echo $prestamo["motivo"] ?></h4>
    <h4>Concepto: <?php echo $prestamo["concepto"] ?></h4>
    <h4>Nombre del Responsable: <?php echo $prestamo["nombre"]." ".$prestamo["apellido"] ?></h4>
    <h4>Fecha del Tramite: <?php echo $prestamo["fecha_tramite"] ?></h4>
    <h4>Concepto: <?php echo $prestamo["duracion"] ?></h4>
    <h4>Restante: <?php echo $restante ?></h4>
    
    <?php 
        if($restante == 1){
            ?>
            <h4>Solicitar prorroga: </h4>
            <form id="form">
                <input type="text" name="clave" placeholder="Ingrese su clave de seguridad">
                <input type="number" placeholder="Duración" name="duracion">
                <textarea name="motivo" placeholder="Motivo"></textarea>
                <button type="submit">Enviar</button>
                <input type="hidden" name="tramite" value="<?php echo $prestamo["id_tramite_bien"] ?>">
                <input type="hidden" name="codigo" value="<?php echo $prestamo["codigo"] ?>">
                <input type="hidden" name="nombre_bien" value="<?php echo $prestamo["nombre_bien"] ?>">
                <input type="hidden" name="id_bien" value="<?php echo $prestamo["id_bien"] ?>">
                <input type="hidden" name="responsable" value="<?php echo $prestamo["responsable"] ?>">
            </form>
            <?php
        }
    ?>
   
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
    <?php
        if($restante == 1){
            ?>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'bienes_prestados',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href = "../bienes_prestados";
                    } else {
                        alert(response)
                    }
                }
            });
        });
        <?php
        }
    ?>
    </script>
</body>
</html>