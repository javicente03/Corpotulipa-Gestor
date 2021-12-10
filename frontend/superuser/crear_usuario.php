<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Usuarios</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        <input type="text" name="nombre" id="nombre">
        <input type="text" name="apellido" id="apellido">
        <input type="email" name="email" id="email">
        <input type="text" name="username" id="username">
        <label for="masculino">Masculino</label>
        <input type="radio" name="genero" id="masculino" value="Masculino" onclick="s(1)">
        <label for="femenino">Femenino</label>
        <input type="radio" name="genero" id="femenino" value="Femenino" onclick="s(1)">
        <label for="otro">Otro</label>
        <input type="radio" name="genero" id="otro" value="Otro" onclick="s(2)">
        <input type="text" name="other" id="other" disabled>
        <select name="departamento" id="departamento">
            <?php
                while($departamentos=$proceso->fetch_assoc()){
                   echo "<option value='".$departamentos['departamento_id']."'>".$departamentos['siglas']."</option>";
                }
            ?>
        </select>
        <select name="cargo" id="cargo">
            <?php
                while($cargos=$proceso1->fetch_assoc()){
                   echo "<option value='".$cargos['cargo_id']."'>".$cargos['cargo']."</option>";
                }
            ?>
        </select>
        <input type="date" name="nacimiento" id="nacimiento">
        <button type="submit" id="crear">Crear</button>        
    </form>
    <table id="tabla">
        <thead>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Cargo</th>
            <th>Departamento</th>
            <th>Acción</th>
            <th>Acción</th>
        </thead>
        <tbody>
        <?php
            while ($usuarios = $proceso2->fetch_assoc()) {
                
            ?>    
		    <tr>
            <td><?php echo $usuarios["nombre"]?></td>
            <td><?php echo $usuarios["apellido"]?></td>
            <td><?php echo $usuarios["email"]?></td>
            <td><?php echo $usuarios["cargo"]?></td>
            <td><?php echo $usuarios["siglas"]?></td>
            <td><a href="editar_usuario/<?php echo $usuarios["id"];?>">Editar</a></td>
            <td><button type="button" onclick="suspender(<?php echo $usuarios['id']?>, <?php if($usuarios['status'] == 'active') echo '1'; else echo '0';  ?>)"><?php if($usuarios['status'] == 'active') echo 'Suspender'; else echo 'Reactivar';  ?></button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div id="div"></div>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        function s(i){
            if(i==1){
                document.getElementById("other").disabled = true
                document.getElementById("other").value = ""
            }
            else
                document.getElementById("other").disabled = false
        }

        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'generar_usuario',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response.substring(response.length-2, response.length) == "ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href = "";
                    } else {
                        alert(response)
                    }
                }
            });
        });

        function suspender(id,x){
            if(x=="1"){
                var accion = "suspended"
                var option = confirm("¿Seguro desea suspender a este usuario?")
            } else {
                var accion = "active"
                var option = confirm("¿Seguro desea reactivar a este usuario?")
            }
            if(option){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'suspender_usuario',
                    data: {id:id,accion:accion},
                    success: function(response)
                    {
                       
                        if(response == "ok"){
                            location.href = ""
                        } else if(response=="¡Oh no, ocurrió un error inesperado!" || 
                            response=="Estatus no válido" || response=="Debe completar los datos correctamente") {
                            alert(response)
                        } else {
                            location.href = "sesion"
                        }
                    }
                });
            }
        }
    </script>    
</body>
</html>