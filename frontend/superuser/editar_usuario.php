<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="container section">
    <div class="row z-depth-2" style="padding: 5px;">
        <form id="form">
            <h4 class="title" style="text-align: center;">Editar Usuario</h4>
            <p class="title" style="text-align: center;">Esta sección permite modificar el cargo de un funcionario, así como asignar
                un nuevo departamento de trabajo según sea el caso.
            </p>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="../<?php echo $usuario["img"] ?>">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">
                            <?php echo $usuario["nombre"] . " " . $usuario["apellido"] ?>
                            <i class="material-icons right">more_vert</i></span>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">
                            <?php echo $usuario["nombre"] . " " . $usuario["apellido"] ?>
                            <i class="material-icons right">close</i></span>
                        <p>Correo: <?php echo $usuario["email"] ?></p>
                        <p>Cédulal: <?php echo $usuario["cedula"] ?></p>
                        <p>Fecha de Nacimiento: <?php echo $usuario["fecha_nacimiento"] ?></p>
                        <p>Genero: <?php echo $usuario["genero"] ?></p>
                    </div>
                </div>
            </div>
            <div class="col s12 m8">
                <div class="row">
                    <div class="input-field col s12">
                        <select name="departamento" id="departamento">
                            <?php
                            while ($departamentos = $proceso2->fetch_assoc()) {
                            ?>
                            <option <?php if($departamentos['departamento_id'] == $usuario['departamento_id']) echo "selected" ?>
                             value="<?php echo $departamentos['departamento_id'] ?>"
                            ><?php echo $departamentos['siglas']."-".$departamentos['departamento'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label>Seleccione un departamento</label>
                    </div>
                    <div class="input-field col s12">
                        <select name="cargo" id="cargo">
                            <?php
                            while ($cargos = $proceso1->fetch_assoc()) {
                            ?>
                                <option
                                <?php if($cargos['cargo_id'] == $usuario['cargo_id']) echo "selected" ?>
                                value="<?php echo $cargos['cargo_id'] ?>"><?php echo $cargos['cargo'] ?></option>
                            <?php   
                            }
                            ?>
                        </select>
                        <label>Indique el cargo</label>
                    </div>
                    <div class="input-field col s12">
                        <button type="submit" class="btn-entrar" id="btn-submit">Editar</button>
                    </div>
                    <div class="progress indigo darken-4" id="progress" style="display: none;">
                        <div class="indeterminate"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $usuario['id_usuario'] ?>">
        </form>
    </div>
</div>

<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script>
    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'editar_usuario',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "";
                } else {
                    M.toast({
                        html: response,
                        classes: 'rounded red'
                    })
                    $("#progress").css("display", "none")
                    $("#btn-submit").prop('disabled', false)
                }
            }
        });
    });
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>