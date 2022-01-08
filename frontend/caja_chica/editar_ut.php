<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>

<div class="container section contenedor">
    <div class="row cont-crear">
        <form id="form">
            <h5 class="title">Editar Datos de Unidad Tributaria</h5>
            <h6 class="title">Para transacciones de la Caja Chica</h6>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">grain</i>
                <input type="number" name="ut" id="ut" value="<?php echo $data['ut'] ?>">
                <label for="ut">Monto máximo en UT</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">grain</i>
                <input type="number" name="cambio" id="cambio" value="<?php echo $data['cambio_ut'] ?>">
                <label for="cambio">Tasa de cambio en bs</label>
            </div>
            <div class="input-field col s12">
                <button type="submit" id="btn-submit" class="btn-entrar">Enviar</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container contenedor">
    <p style="text-align: center; background-color: gray; padding: 10px;border-radius: 1em;font-weight: bold;color:black;margin-bottom:10px;">
        <i class="material-icons left">error</i>
        Monto máximo permitido para una transacción de caja chica expresado en Unidades Tributarias</p>
    <p style="text-align: center; background-color: gray; padding: 10px;border-radius: 1em;font-weight: bold;color:black;margin-bottom:10px;">
        <i class="material-icons left">error</i>
        El campo Tasa de cambio hace referencia a la cantidad equivalente a 1 Unidad Tributaria</p>
    <div class="row" style="border-radius: 1em;border:#040729 solid 5px;padding: 10px;box-shadow: black 4px 4px 4px;">
        <h4 class="title" style="text-align: center;">Fondo Actual de Caja Chica</h4>
        <h3 class="title" style="text-align: center;"><?php echo $data1['fondo_actual'] ?> <small>UT</small></h3>
    </div>
</div>

<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>

<script>
    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'editar_ut',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>")
                    location.href = ""
                else{
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