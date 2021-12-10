<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Solicitudes de Caja Chica</title>
</heads>
<body>
    <?php
        if(!isset($router))
            header("Location: ../../404");
    ?>
    
    <table>
        <thead>
            <th>Solicitante</th>
            <th>Monto en Bs</th>
            <th>Unidades Tributarias</th>
            <th>Fecha de la solicitud</th>
            <th>Motivo</th>
            <th>Ver Facturas</th>
            <th>Acción</th>
        </thead>
        <tbody>
        <?php
            while($data = $ejecutar->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $data['username'] ?></td>
                <td><?php echo $data['bs'] ?></td>
                <td><?php echo $data['ut_pedido'] ?></td>
                <td><?php echo $data['fecha'] ?></td>
                <td><?php echo $data['motivo'] ?></td>
                <td><button onclick="facturas(<?php echo $data['id_sol_cc'] ?>)">Facturas</button</td>
                <td><button onclick="aceptar(<?php echo $data['id_sol_cc'] ?>)">Validar</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <br><br><br><br><br>
    <div id="imgs">

    </div>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>

        function aceptar(id){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'validar_sol_cc',
                data: {id:id},
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>")
                        location.href = ""
                    else 
                        alert(response)
                }
            });
        }

        function facturas(id){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'validar_sol_cc',
                data: {id:id,factura:1},
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    document.getElementById("imgs").innerHTML = response
                }
            });
        }

    </script>    
</body>
</html>