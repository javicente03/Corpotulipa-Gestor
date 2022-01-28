<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="row">
    <?php include("frontend/modularizacion/lateral_page.php") ?>
    <div class="col m12 l9 contenido-principal">
<div class="container section">
    <div class="row">
        <h5 class="title">Información</h5>
        <table class="responsive-table striped z-depth-3 centered">
            <thead class="table-head">
                <th>Nivel Actual</th>
                <th>Nivel Requerido</th>
                <th>Fecha</th>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $participante["nivel_actual"] ?></td>
                    <td><?php echo $participante["nivel_requerido"] ?></td>
                    <td><?php echo $participante["fecha_adiestramiento"] ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php
    $hoy = date("Y-m-d");
    if ($hoy > $participante["fecha_adiestramiento"]) {
    ?>
        <div class="row cont-crear">
            <form id="form">
                <h5 class="title">Por favor conteste el siguiente cuestionario</h5>
                <div class="col s12 input-field">
                    <div class="row">
                        <h6 class="title">¿En qué medida fue útil y aplicable para su cargo la experiencia
                            adquirida en el adiestramiento?</h6>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="primera" id="primera1" value="Poco">
                                    <span>Poco</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="primera" id="primera2" value="Moderado">
                                    <span>Moderado</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="primera" id="primera3" value="Mucho">
                                    <span>Mucho</span>
                                </label></p>
                        </div>
                    </div>
                </div>
                <div class="col s12 input-field">
                    <div class="row">
                        <h6 class="title">¿El contenido del curso cumplió con sus expectativas?</h6>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="segunda" id="segunda1" value="Poco">
                                    <span>Poco</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="segunda" id="segunda2" value="Moderado">
                                    <span>Moderado</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="segunda" id="segunda3" value="Mucho">
                                    <span>Mucho</span>
                                </label></p>
                        </div>
                    </div>
                </div>
                <div class="col s12 input-field">
                    <div class="row">
                        <h6 class="title">¿El Facilitador tuvo habilidad para transmitir conocimientos y aclarar
                            dudas?</h6>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="tercera" id="tercera1" value="Poco">
                                    <span>Poco</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="tercera" id="tercera2" value="Moderado">
                                    <span>Moderado</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="tercera" id="tercera3" value="Mucho">
                                    <span>Mucho</span>
                                </label></p>
                        </div>
                    </div>
                </div>
                <div class="col s12 input-field">
                    <div class="row">
                        <h6 class="title">¿Como considera que fue la organización del adiestramiento?</h6>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="cuarta" id="cuarta1" value="Malo">
                                    <span>Malo</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="cuarta" id="cuarta2" value="Regular">
                                    <span>Regular</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="cuarta" id="cuarta3" value="Bueno">
                                    <span>Bueno</span>
                                </label></p>
                        </div>
                    </div>
                </div>
                <div class="col s12 input-field">
                    <div class="row">
                        <h6 class="title">¿Cómo califica el ambiente en el cual se desarrollo el adiestramiento?</h6>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="quinta" id="quinta1" value="Malo">
                                    <span>Malo</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="quinta" id="quinta2" value="Regular">
                                    <span>Regular</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="quinta" id="quinta3" value="Bueno">
                                    <span>Bueno</span>
                                </label></p>
                        </div>
                    </div>
                </div>
                <div class="col s12 input-field">
                    <div class="row">
                        <h6 class="title">¿Cómo califica el material de apoyo suministrado?</h6>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="sexta" id="sexta1" value="Malo">
                                    <span>Malo</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="sexta" id="sexta2" value="Regular">
                                    <span>Regular</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="sexta" id="sexta3" value="Bueno">
                                    <span>Bueno</span>
                                </label></p>
                        </div>
                    </div>
                </div>
                <div class="col s12 input-field">
                    <div class="row">
                        <h6 class="title">¿Cómo califica el facilitador, ponente o instructor al motivar al grupo?</h6>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="septima" id="septima1" value="Malo">
                                    <span>Malo</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="septima" id="septima2" value="Regular">
                                    <span>Regular</span>
                                </label></p>
                        </div>
                        <div class="col s12 m4">
                            <p><label>
                                    <input type="radio" class="with-gap" name="septima" id="septima3" value="Bueno">
                                    <span>Bueno</span>
                                </label></p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 input-field">
                    <textarea name="conocimientos" id="conocimientos" class="materialize-textarea"></textarea>
                    <label for="conocimiento">Indique los conocimientos aprendidos</label>
                </div>
                <div class="col s12 m6 input-field">
                    <textarea name="recomendaciones" id="recomendaciones" class="materialize-textarea"></textarea>
                    <label for="recomendaciones">Indique sus recomendaciones</label>
                </div>
                <div class="col s12 input-field">
                    <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                    <div class="progress indigo darken-4" id="progress" style="display: none;">
                        <div class="indeterminate"></div>
                    </div>
                </div>
                <input type="hidden" name="adiestramiento" value="<?php echo $participante["id_adiestramiento"] ?>">
            </form>
        </div>
    <?php
    }
    ?>
</div>
    </div></div>

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
            url: 'ver_adiestramiento',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "../sesion";
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