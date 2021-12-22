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
    ?>
    
    <table>
        <thead>
            <th>Código</th>
            <th>Número de Identificación</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th>Existe</th>
        </thead>
        <tbody>
            <?php
                $total = 0;
                while ($i = $inventario->fetch_assoc()) {
                
                $total += $i["valor"];
            ?>
            <tr>
                <td><?php echo $i["codigo"] ?></td>
                <td><?php echo $i["id_bien"] ?></td>
                <td><?php echo $i["nombre_bien"] ?></td>
                <td><?php echo $i["descripcion"] ?></td>
                <td><?php echo $i["valor"] ?></td>
                <td><input onchange="marcado(<?php echo $i['id_bien'] ?>)" checked type="checkbox" name="existe<?php echo $i["id_bien"] ?>" id="existe<?php echo $i["id_bien"] ?>"></td>
            </tr>
            <?php
                }
            ?>
            <td></td>
            <td></td>
            <td></td>
            <td>Total:</td>
            <td><?php echo $total ?></td>
        </tbody>
    </table>
    
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        var array = Array()
        <?php while ($a = $inventario2->fetch_assoc()) {
        ?>    
            array.push(<?php echo $a["id_bien"] ?>)
        <?php } ?> 
        console.log(array)

        function marcado(id){
            if(document.getElementById("existe"+id).checked)
                array.push(id)
            else {
                var pos = array.indexOf(id)
                array.splice(pos,1)
            }
            console.log(array)
        }


        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'aprobar_inventario',
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