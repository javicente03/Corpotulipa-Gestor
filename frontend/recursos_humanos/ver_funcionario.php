<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="row">
    <?php include("frontend/modularizacion/lateral_page.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <div class="row">
                <h5 class="title">Funcionario</h5>
                <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
                    <h6><b><?php echo $funcionario["nombre"] . " " . $funcionario["apellido"] ?></b></h6>
                </div>
                <div class="col s12 m9 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $funcionario["departamento"] ?></b></h6>
                </div>
                <div class="col s12 m3 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $funcionario["siglas"] ?></b></h6>
                </div>
                <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $funcionario["cargo"] ?></b></h6>
                </div>
                <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Fecha de Nacimiento: <?php echo $funcionario["fecha_nacimiento"] ?></b></h6>
                </div>
                <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Genero: <?php echo $funcionario["genero"] ?></b></h6>
                </div>
                <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Correo Electrónico: <?php echo $funcionario["email"] ?></b></h6>
                </div>
                <div class="col s12 m5 z-depth-3">
                    <img src="../<?php echo $funcionario["img"] ?>" alt="Imágen del funcionario" class="responsive-img materialboxed">
                </div>
                <div class="col s12 m7">
                <ul class="collection with-header lista-permisos">
                    <li class="collection-header"><h5 class="title">Solicitudes de Permiso Realizadas</h5></li>
                    <?php while($row = $permisos->fetch_assoc()){ ?>
                        <li class="collection-item">
                            °
                            Desde: <?php echo $row["fecha_inicio"] ?> / Hasta <?php echo $row["fecha_fin"] ?>
                            Estatus: <?php 
                                if($row["aprobado"]){
                                    echo "Aprobada";
                                } else if($row["aprobado"] && $row["fecha_respuesta" !=NULL]){
                                    echo "Rechazada";
                                } else
                                    echo "En espera";
                            ?>
                            <br> Motivo: <?php echo $row["motivo"] ?>
                        </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script src="../frontend/js/notificaciones-page.js"></script>

<?php
include("frontend/modularizacion/cierre_html.php");
?>