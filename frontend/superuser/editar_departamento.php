<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="row">
    <?php include("frontend/modularizacion/lateral_page.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <div class="row cont-crear">
                <form id="form">
                    <h5 class="title">Editar Departamento</h5>
                    <div class="input-field col s12 m6">
                        <input type="text" name="siglas" id="siglas" value="<?php echo $siglas ?>">
                        <label for="siglas">Siglas</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>">
                        <label for="nombre">Nombre del departamento</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="sede" id="sede">
                            <option value="Pueblo Nuevo" <?php if ($sede == "Pueblo Nuevo") echo "selected" ?>>Pueblo Nuevo</option>
                            <option value="Punto Fijo" <?php if ($sede == "Punto Fijo") echo "selected" ?>>Punto Fijo</option>
                        </select>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="hidden" name="id" value="<?php echo $data['departamento_id'] ?>">
                        <button type="submit" class="btn-entrar" id="btn-submit">Editar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
            url: 'editar_departamento',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok") {
                    location.href = "../departamentos"
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
<?php
include("frontend/modularizacion/cierre_html.php");
?>