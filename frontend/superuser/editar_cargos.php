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
                    <h5 class="title">Editar Cargo</h5>
                    <div class="col s12 m6">
                        <input type="number" name="rango" id="rango" value="<?php echo $rango ?>">
                        <label for="rango">Rango</label>
                    </div>
                    <div class="col s12 m6">
                        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>">
                        <label for="nombre">Nombre del Cargo</label>
                    </div>
                    <div class="col s12">
                        <input type="hidden" name="id" value="<?php echo $data['cargo_id'] ?>">
                        <button type="submit" class="btn-entrar" id="btn-submit">Editar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </form>
            </div>
            <p class="parrafo"><i class="material-icons left">error</i>Indique Rango 1 si este cargo tiene autorización para aprobar 
                solicitud de permiso laboral, Rango 2 para el resto del personal</p>
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
            url: 'editar_cargo',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok") {
                    location.href = "../cargos"
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