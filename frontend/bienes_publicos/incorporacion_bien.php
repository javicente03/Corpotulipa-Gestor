<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");
?>

<div class="row">
    <?php include("frontend/modularizacion/lateral.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <div class="row cont-crear">
                <form id="form">
                    <h5 class="title">Incorporar Bienes Públicos</h5>
                    <div class="input-field col s12 m6">
                        <div class="row">
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" class="with-gap" name="tipo" id="optM" value="Mueble">
                                        <span class="black-text"><b>Mueble</b></span>
                                    </label></p>
                            </div>
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" name="tipo" id="optI" value="Inmueble" class="with-gap">
                                        <span class="black-text"><b>Inmueble</b></span>
                                    </label></p>
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="organismo" name="organismo" required class="validate">
                        <label for="organismo">* Organismo</label>
                        <span class="helper-text" data-error="Este dato es requerido" data-success=""></span>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="denoOrga" name="denoOrga">
                        <label for="denoOrga">Denominación de la Organización</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="departamento" id="departamento">
                            <?php
                            while ($departamento = $departamentos->fetch_assoc()) {
                                $id = $departamento["departamento_id"];
                                echo "<option value='$id'>" . $departamento['siglas'] . "</option>";
                            }
                            ?>
                        </select>
                        <label id="departamento">* Departamento al que será entregado</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="denoDepa" name="denoDepa">
                        <label for="denoDepa">Denominación del Departamento</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="dependencia" name="dependencia" required class="validate">
                        <label for="dependencia">* Dependencia Usuaria</label>
                        <span class="helper-text" data-error="Este dato es requerido" data-success=""></span>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="denoUsu" name="denoUsu">
                        <label for="denoUsu">Denominación de Usuario</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="number" id="valor" name="valor" required class="validate">
                        <label for="valor">* Valor Unitario</label>
                        <span class="helper-text" data-error="Este dato es requerido y de tipo numérico" data-success=""></span>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="catalogo" id="catalogo" required class="validate">
                        <label for="catalogo">* Código de SUDEBIP</label>
                        <!-- <span class="helper-text" data-error="Este dato es requerido y de tipo numérico" data-success=""></span> -->
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="responsable" id="responsable">
                            <?php
                            while ($u = $usuarios->fetch_assoc()) {
                                $id = $u["id"];
                                echo "<option value='$id' data-icon='" . $u["img"] . "'>" . $u['nombre'] . " " . $u['apellido'] . " | " . $u['cargo'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="responsable">* Indique quien será el responsable</label>
                    </div>
                    <!-- Muebles -->
                    <div id="contMueble" style="display:none">
                        <div class="col s12 m6 input-field">
                            <input type="text" id="mueble" name="mueble">
                            <label for="mueble">* Nombre del bien</label>
                        </div>
                        <div class="col s12 m6 input-field">
                            <textarea class="materialize-textarea validate" data-length="2000" id="descripcion" name="descripcion"></textarea>
                            <label for="descripcion">* Descripción del bien</label>
                            <span class="helper-text" data-error="Este dato es requerido y no debe exceder los 2000 caracteres" data-success=""></span>
                        </div>
                    </div>
                    <!-- Inmuebles -->
                    <div id="contInmueble" style="display:none">
                        <div class="input-field col s12 m6">
                            <input type="number" id="catastro" name="catastro">
                            <label for="catastro">Número de Catastro</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input type="text" id="inmueble" name="inmueble">
                            <label style="font-weight: bold;" for="inmueble">Nombre del Inmueble</label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <button class="btn-entrar" id="btn-submit">Guardar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </form>
            </div>
            <p class="parrafo"><i class="material-icons left">error</i>
                Tenga presente que los datos con (*) son obligatorios</p>
        </div>
    </div>
</div>


<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>

<script>
    $(document).ready(function() {
        $('#descripcion').characterCounter();
    });

    $("#optM").click(function() {
        if ($(this).prop("checked")) {
            $("#contMueble").css("display", "block")
            $("#contInmueble").css("display", "none")
        }
    })

    $("#optI").click(function() {
        if ($(this).prop("checked")) {
            $("#contInmueble").css("display", "block")
            $("#contMueble").css("display", "none")
        }
    })

    $('#form').submit(function(e) {
        if ($("#optM").prop("checked") || $("#optI").prop("checked")) {
            $("#progress").css("display", "block")
            $("#btn-submit").prop('disabled', true)
            $("#btn-submit").css('background', 'gray')
            $.ajax({
                type: "POST",
                url: 'incorporar_bien',
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
                        $("#btn-submit").css('background', '#1a237e')
                    }
                }
            });
        } else {
            M.toast({
                html: "Debe seleccionar si el bien es mueble o inmueble",
                classes: 'rounded red'
            })
            $("#progress").css("display", "none")
            $("#btn-submit").prop('disabled', false)
            $("#btn-submit").css('background', '#1a237e')
        }
        e.preventDefault();
    });
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>