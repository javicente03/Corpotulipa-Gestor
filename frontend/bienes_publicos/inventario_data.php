<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Inventario</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");       
        if($inventario["aprobado"] && $inventario["fecha_fin_inventario"] ==null){
            
    ?>
    <h4>Gerente: <?php echo $inventario["nombre"]." ".$inventario["apellido"] ?></h4>
    <h4>Departamento: <?php echo $inventario["departamento"]." - ".$inventario["siglas"] ?></h4>
    <h4>Fecha de Toma: <?php echo $inventario["fecha_inventario_dep"] ?></h4>
    <a href="?pdf=1">Ver Reporte PDF</a>
    <table>
        <thead>
            <th>Nombre</th>
            <th>Código del Catálogo</th>
            <th>Identificación</th>
            <th>Valor</th>
            <th>Eliminar</th>
        </thead>
        <tbody>
            <?php
                $total = 0;
                while ($i = $data->fetch_assoc()) {
                    $total += $i["valor"];
            ?>
            <tr>
                <td><?php echo $i["nombre_bien"] ?></td>
                <td><?php echo $i["catalogo"] ?></td>
                <td><?php echo $i["codigo"] ?></td>
                <td><?php echo $i["valor"] ?></td>
                <td><input onchange="marcado(<?php echo $i['id_bien'] ?>)" type="checkbox" id="noexiste<?php echo $i["id_bien"] ?>"></td>
            </tr>
            <?php
                }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td>Total:</td>
                <td><?php echo $total ?></td>
            </tr>
        </tbody>
    </table>
    <form id="form">
        <input type="text" name="clave" placeholder="Ingrese su clave de seguridad">
        <button type="submit">Enviar</button>
        <input type="hidden" name="inventario" value="<?php echo $id_data ?>">
    </form>
    <?php
        } else
            echo "El inventario relacionado a esta toma culminó";
    ?>
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        var array = Array()

        function marcado(id){
            if(document.getElementById("noexiste"+id).checked)
                array.push(id)
            else {
                var pos = array.indexOf(id)
                array.splice(pos,1)
            }
            console.log(array)
        }

        $('#form').submit(function(e) {
            var formData = new FormData(document.getElementById("form"));
            formData.append('array', JSON.stringify(array));
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'inventario_data',
                data: formData,
                enctype:'application/x-www-form-urlencoded',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
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