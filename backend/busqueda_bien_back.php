<?php
if(isset($router)){
    $bien = trim(addslashes($_POST["bien"]));

    $resultados = $bd->query("SELECT * FROM bienes_publicos B LEFT JOIN usuario U ON B.responsable=U.id LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D ON P.departamento_id=D.departamento_id WHERE nombre_bien = '$bien'");
    while ($resultado = $resultados->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $resultado["codigo"] ?></td>
            <td><?php echo $resultado["tipo"] ?></td>
            <td><?php echo $resultado["nombre_bien"] ?></td>
            <td><?php echo $resultado["descripcion"] ?></td>
            <td><?php echo $resultado["nombre"]." ".$resultado["apellido"]?></td>
            <td><?php echo $resultado["siglas"] ?></td>
            <td><a href="prestamo_bien/<?php echo $resultado["id_bien"] ?>">Solicitar</a></td>
        </tr>
    <?php
    }
} else
    header("Location: ../404");