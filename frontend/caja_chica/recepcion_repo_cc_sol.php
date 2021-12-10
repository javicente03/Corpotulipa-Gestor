<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Solicitud de Reposición de Caja Chica</title>
</head>

<body>
    <table>
            <thead>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Bs</span></th>
                        <th>UT</th>
                        <th>Motivo</th>
                        <th>Facturas</th>
                        <th>Total Bs</th>
                        <th>Total UT</th>
                    </tr>
                </thead>
            </thead>
            <tbody>
            <?php
                while($data = $solicitudes->fetch_assoc()){
                    $bs += $data['bs'];
                    $ut += $data['ut_pedido'];
                ?>
                <tr>
                    <td><?php echo $data['fecha'] ?></td>
                    <td><?php echo $data['bs'] ?></td>
                    <td><?php echo $data['ut_pedido'] ?></td>
                    <td><?php echo $data['motivo'] ?></td>
                    <td><button onclick="facturas(<?php echo $data['id_sol_cc'] ?>)">Facturas</button</td>
                    <td></td>
                    <td></td>
                    
                </tr>
            <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $bs ?></td>
                    <td><?php echo $ut ?></td>
                </tr>
            </tbody>
        </table>
        
        <p>Fondo Actual: <?php echo $cc['fondo_actual'] ?></p>
        <form id="form">
            <input type="text" name="clave">
            <input type="hidden" name="id" value="<?php echo $router->getParam() ?>">
            <button type="submit">Enviar</button>
        </form>
        <form id="form2">
            <input type="text" name="clave">
            <input type="text" name="motivo">
            <select name="cargo">
                <?php
                    while($cargo=$cargos->fetch_assoc()){
                        echo "<option value='".$cargo['cargo_id']."'>".$cargo['cargo']."</option>";
                    }
                ?>
            </select>
            <input type="hidden" name="id" value="<?php echo $router->getParam() ?>">
            <button type="submit">Enviar</button>
        </form>
        <br><br><br><br><br>
        <div id="imgs">
        </div>
                    
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        function facturas(id){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'recepcion_repo_cc',
                data: {id:id,factura:1},
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    document.getElementById("imgs").innerHTML = response
                }
            });
        }

        $('#form').submit(function(e) {
            var formData = new FormData(document.getElementById("form"));
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'recepcion_repo_cc',
                data: formData,
                enctype:'application/x-www-form-urlencoded',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href="../recepcion_repo_cc/"
                    } else {
                        alert(response)
                    }
                }
            });
        });

        $('#form2').submit(function(e) {
            var formData = new FormData(document.getElementById("form2"));
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'recepcion_repo_cc',
                data: formData,
                enctype:'application/x-www-form-urlencoded',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href="../recepcion_repo_cc/"
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>

</html>