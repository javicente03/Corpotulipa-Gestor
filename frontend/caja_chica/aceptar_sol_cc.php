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
                <td><button onclick="aceptar(<?php echo $data['id_sol_cc'] ?>)">Aceptar</button>
                <button onclick="descartar(<?php echo $data['id_sol_cc'] ?>)">Descartar</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>


    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>

        function aceptar(id){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'solicitudes_cc',
                data: {id:id,method:'ac'},
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

        function descartar(id){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'solicitudes_cc',
                data: {id:id,method:'dc'},
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

    </script>    
</body>
</html>