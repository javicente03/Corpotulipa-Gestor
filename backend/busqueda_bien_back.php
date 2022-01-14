<?php
if (isset($router)) {
    $bien = trim(addslashes($_POST["bien"]));
    $dep = trim(addslashes($_POST["departamento"]));

    if ($dep == 0) {
        // $resultados = $bd->query("SELECT * FROM bienes_publicos B LEFT JOIN usuario U ON B.responsable=U.id LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D ON P.departamento_id=D.departamento_id WHERE nombre_bien = '$bien' AND responsable IS NOT NULL");
        $resultados = $bd->query("SELECT *, MATCH (nombre_bien) AGAINST ('$bien') AS puntuacion FROM 
                                bienes_publicos B LEFT JOIN usuario U ON B.responsable=U.id LEFT JOIN 
                                perfil P ON U.id=P.id_usuario LEFT JOIN departamento D ON 
                                B.departamento_id=D.departamento_id WHERE MATCH (nombre_bien) 
                                AGAINST ('$bien') AND responsable IS NOT NULL ORDER BY puntuacion DESC");
    } else {
        $resultados = $bd->query("SELECT *, MATCH (nombre_bien) AGAINST ('$bien') AS puntuacion FROM 
                                bienes_publicos B LEFT JOIN usuario U ON B.responsable=U.id LEFT JOIN 
                                perfil P ON U.id=P.id_usuario LEFT JOIN departamento D ON 
                                B.departamento_id=D.departamento_id WHERE MATCH (nombre_bien) 
                                AGAINST ('$bien') AND B.departamento_id=$dep AND responsable IS NOT NULL ORDER BY puntuacion DESC");
    }


    if ($resultados->num_rows > 0) {
        while ($resultado = $resultados->fetch_assoc()) {
?>
            <tr>
                <td><?php echo $resultado["codigo"] ?></td>
                <td><?php echo $resultado["tipo"] ?></td>
                <td><?php echo $resultado["nombre_bien"] ?></td>
                <td><b><?php echo $resultado["nombre"] . " " . $resultado["apellido"] ?></b></td>
                <td><?php echo $resultado["siglas"] ?></td>
                <td><a class="btn btn-flat" href="prestamo_bien/<?php echo $resultado["id_bien"] ?>">
                        <i class="material-icons large">create_new_folder</i></a></td>
            </tr>
<?php
        }
    } else
        echo "<tr><td>No hay coincidencias</td></tr>";
} else
    header("Location: ../404");
