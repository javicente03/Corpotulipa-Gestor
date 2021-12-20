<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Cargos</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        <select name="accion" id="accion">
            <option value="Editar_UT_Caja_Chica">Editar UT Caja Chica</option>
            <option value="Aceptar_Sol_CC">Aceptar Solicitud de Caja Chica</option>
            <option value="Recepcion_Repo_CC">Recepción de Reposición de Caja Chica</option>
            <option value="Coordinacion_Repo_CC">Coordinación de Reposición de Caja Chica</option>
            <option value="Analisis_Repo_CC">Analisis de Reposición de Caja Chica</option>
            <option value="Contador_Repo_CC">Contador de Reposición de Caja Chica</option>
            <option value="Gerencia_Repo_CC">Gerencia Reposición de Caja Chica</option>
            <option value="Incorporacion_Muebles">Incorporar Muebles e Inmuebles</option>
            <option value="Generar_Nota">Generar Nota de Entrega Muebles e Inmuebles</option>
            <option value="Prestar_Bien_Publico">Prestar Bienes Muebles e Inmuebles</option>
            <option value="Movimiento_Bienes">Efectuar Movimiento Muebles e Inmuebles</option>
            <option value="Reporte_Bien">Revision de Reportes Muebles Faltantes</option>
            <option value="Desincorporar_Bien">Desincorporar Bien</option>

        </select>
        <select name="cargo" id="cargo">
            <?php
                while($cargos=$proceso1->fetch_assoc()){
                   echo "<option value='".$cargos['cargo_id']."'>".$cargos['cargo']."</option>";
                }
            ?>
        </select>
        <button type="submit" id="crear" >Crear</button>        
    </form>
    <table id="tabla">
        <thead>
            <th>Acción</th>
            <th>Cargo</th>
            <th>Eliminar</th>
        </thead>
        <tbody>
            <?php
            while ($data = $proceso->fetch_assoc()) {
            ?>    
		    <tr>
            <td><?php echo $data["accion"]?></td>
            <td><?php echo $data["cargo"]?></td>
            <td><button type="button" onclick="eliminar(<?php echo $data['permiso_id']?>)">Eliminar</button></td>
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
                url: 'permisos',
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

        function eliminar(id){
            option = confirm("¿Seguro desea eliminar este Permiso?");
            if (option) {           
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'eliminar_permiso',
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