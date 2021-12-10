<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Departamentos</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        <input type="text" name="siglas" id="siglas">
        <input type="text" name="nombre" id="nombre">
        <button type="submit" id="crear" >Crear</button>        
    </form>
    <table id="tabla">
        <thead>
            <th>Siglas</th>
            <th>Nombre</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </thead>
        <tbody>
            <?php
            while ($data = $proceso->fetch_assoc()) {
            ?>    
		    <tr>
            <td><?php echo $data["siglas"]?></td>
            <td><?php echo $data["departamento"]?></td>
            <td><a href="editar_departamento/<?php echo $data["departamento_id"];?>">Editar</a></td>
            <td><button type="button" onclick="eliminar(<?php echo $data['departamento_id']?>)">Eliminar</button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'departamentos',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response)
                {
                    var jsonData = JSON.parse(response);
                    if(jsonData.texto=="ok"){
                        var fila = "<tr><td>"+$('#siglas').val()+"</td><td>"+$('#nombre').val()+"</td><td><a href='editar_departamento/"+jsonData.id+"'>Editar</a></td><td><button onclick='eliminar("+jsonData.id+")'>Eliminar</button></td></tr>"
                        var tr = document.createElement("TR")
                            tr.innerHTML = fila;
                            document.getElementById("tabla").appendChild(tr);
                    } else {
                        alert(jsonData.texto)
                    }
                }
            });
        });

        function eliminar(id){          
            option = confirm("¿Seguro desea eliminar este departamento?");
            if (option) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'eliminar_departamento',
                    data: {id:id},
                    success: function(response)
                    {
                        if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                            location.href=""
                        } else {
                            alert(response)
                        }
                    }
                });
            }
        }
    </script>    
</body>
</html>