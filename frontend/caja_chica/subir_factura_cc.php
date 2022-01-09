<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="container ">
    <div class="section">
        <div class="row cont-crear">
            <form id="form">
                <h5 class="title">Subir facturas de compra</h5>
                <div class="file-field input-field col s12">
                    <div class="btn indigo darken-4">
                        <span><i class="material-icons">add_a_photo</i></span>
                        <input type="file" name="factura" id="factura">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="input-field col s12">
                    <button type="submit" class="btn-entrar" id="btn-submit">Subir</button>
                    <div class="progress indigo darken-4" id="progress" style="display: none;">
                        <div class="indeterminate"></div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $solicitud['id_sol_cc'] ?>">
                </div>
            </form>
            <div class="col s12">
                <div class="row">
                    <h6 class="title">Facturas subidas</h6>
                    <?php
                    // echo $solicitud['fecha'] . " " . $solicitud['bs'] . " " . $solicitud['ut_pedido'];
                    while ($img = $facturas->fetch_assoc()) {
                    ?>
                        <div class="col s12 m4" style="margin:4px 0;">
                            <img class="materialboxed responsive-img" src="../<?php echo $img['factura'] ?>">
                        </div>
                    <?php
                    }
                    ?>
                </div>
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
        var formData = new FormData(document.getElementById("form"));
        formData.append('factura', $('#factura')[0].files[0]);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'subir_factura_cc',
            data: formData,
            enctype: 'multipart/form-data',
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = ""
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