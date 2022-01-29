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
            <div class="row cont-crear">
                <h5 class="title">Generar Nota de Entrega: <?php echo $bien["nombre_bien"] ?></h5>
                <form id="form">
                    <div class="input-field col s12 m6">
                        <select name="revisado" id="revisado">
                            <?php
                            while ($usuario = $usuarios->fetch_assoc()) {
                                echo "<option value='" . $usuario['id'] . "'>" . $usuario['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="revisado">Revisado por</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="verificado" id="verificado">
                            <?php
                            while ($usuario = $usuarios2->fetch_assoc()) {
                                echo "<option value='" . $usuario['id'] . "'>" . $usuario['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="verificado">Verificado Por:</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="validado" id="validado">
                            <?php
                            while ($usuario = $usuarios3->fetch_assoc()) {
                                echo "<option value='" . $usuario['id'] . "'>" . $usuario['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="validado">Validado Por:</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="hidden" name="incorporacion" value="<?php echo $bien["id_bien"] ?>">
                        <button type="submit" class="btn-entrar" id="btn-submit">Generar Nota</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </form>
            </div>
            <h5 class="title">Información del bien</h5>
            <ul class="collection">
                <li class="collection-item avatar">
                    <img src="../<?php echo $bien["img"] ?>" alt="" class="circle">
                    <span class="title"><?php echo $bien["nombre_bien"] ?></span>
                    <p><b>Responsable:</b> <?php echo $bien["nombre"] . " " . $bien["apellido"] ?><br>
                    </p>
                    <p><b>Descripción:</b>
                        <?php
                        echo $bien["descripcion"];
                        ?>
                    </p>
                    <p><b>Tipo:</b>
                        <?php
                        echo $bien["tipo"];
                        ?>
                    </p>
                    <a href="#!" class="secondary-content"><?php echo $bien["valor"] ?> Bs</a>

                </li>
            </ul>
            <p class="parrafo"><i class="material-icons left">error</i>
                Por favor seleccione a las 3 personas que deberán validar la adquisición del bien</p>
        </div>
    </div>
</div>
<!-- Llenar la pantalla con mas datos -->

<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script src="../frontend/js/notificaciones-page.js"></script>

<script>
    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'generar_nota_entrega',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "../generar_nota_entrega";
                } else {
                    M.toast({
                        html: response,
                        classes: 'rounded red'
                    })
                    $("#progress").css("display", "none")
                    $("#btn-submit").prop('disabled', false)
                    $("#btn-submit").css('background', '#1a237e')
                }
            }
        });
    });
</script>
</body>

</html>