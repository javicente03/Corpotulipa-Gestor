<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Edición de usuarios</title>
</head>
<body> 
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        
        <select name="departamento" id="departamento">
            <?php
                while($departamentos=$proceso2->fetch_assoc()){ ?>
                   <option value='<?php echo $departamentos['departamento_id'] ?>' <?php if($departamentos['departamento_id'] == $usuario['departamento_id']) echo "selected" ?>>
                   <?php echo $departamentos['siglas'] ?></option>
                <?php }
            ?>
        </select>
        <select name="cargo" id="cargo">
            <?php
                while($cargos=$proceso1->fetch_assoc()){ ?>
                    <option value='<?php echo $cargos['cargo_id'] ?>' <?php if($cargos['cargo_id'] == $usuario['cargo_id']) echo "selected" ?>>
                    <?php echo $cargos['cargo'] ?></option>
                 <?php }
            ?>
        </select>
        <input type="hidden" name="id" value="<?php echo $usuario['id_usuario'] ?>">
        <button type="submit" id="crear">Crear</button>        
    </form>
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>

        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'editar_usuario',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
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