<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>

<style>
    label>span {
        font-weight: bold;
        color: black;
    }
</style>

<div class="row">
    <?php include("frontend/modularizacion/lateral.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <div class="row cont-crear">
                <h5 class="title">Solicitar un nuevo proceso de adiestramiento</h5>
                <form id="form">
                    <h6 class="title">Método de desarrollo de competencia</h6>
                    <div class="input-field col s12 m6">
                        <div class="row">
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" name="metodo" id="curso" value="Curso">
                                        <span>Curso</span>
                                    </label></p>
                            </div>
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" name="metodo" id="taller" value="Taller">
                                        <span>Taller</span>
                                    </label></p>
                            </div>
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" name="metodo" id="congreso" value="Congreso">
                                        <span>Congreso</span>
                                    </label></p>
                            </div>
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" name="metodo" id="foro" value="Foro">
                                        <span>Foro</span>
                                    </label></p>
                            </div>
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" name="metodo" id="otros" value="Otros">
                                        <span>Otros</span>
                                    </label></p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="row">
                            <h6 class="title" style="text-align: center;">Empleados de su departamento</h6>
                            <?php
                            while ($participante = $participantes->fetch_assoc()) { ?>
                                <div class="col s12">
                                    <hr style="border: 1px dashed #1a237e;">

                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col s12">
                                            <p><label>
                                                    <input class="filled-in" type="checkbox" id="user<?php echo $participante["id"] ?>" onclick="marcado(<?php echo $participante['id'] ?>)">
                                                    <span><?php echo $participante["nombre"] . " " . $participante["apellido"] . " - " . $participante["cargo"] ?></span>
                                                </label></p>
                                        </div>

                                        <div class="col s12 m2">
                                            <span class="title">Nivel Necesario</span>
                                        </div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel1<?php echo $participante["id"] ?>" id="c<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante['id'] ?>,"Conoce")>
                                                    <span>Conoce</span>
                                                </label></p>
                                        </div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel1<?php echo $participante["id"] ?>" id="a<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante["id"] ?>,"Aplica")>
                                                    <span>Aplica</span>
                                                </label></p>
                                        </div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel1<?php echo $participante["id"] ?>" id="d<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante["id"] ?>,"Domina")>
                                                    <span>Domina</span>
                                                </label></p>
                                        </div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel1<?php echo $participante["id"] ?>" id="av<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante["id"] ?>,"Avanzado")>
                                                    <span>Avanzado</span>
                                                </label></p>
                                        </div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel1<?php echo $participante["id"] ?>" id="e<?php echo $participante["id"] ?>" onclick=requerido(<?php echo $participante["id"] ?>,"Experto")>
                                                    <span>Experto</span>
                                                </label></p>
                                        </div>
                                        <div class="col s12 m2"><span class="title">Nivel Actual</span></div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel2<?php echo $participante["id"] ?>" id="c1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Conoce")>
                                                    <span>Conoce</span>
                                                </label></p>
                                        </div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel2<?php echo $participante["id"] ?>" id="a1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Aplica")>
                                                    <span>Aplica</span>
                                                </label></p>
                                        </div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel2<?php echo $participante["id"] ?>" id="d1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Domina")>
                                                    <span>Domina</span>
                                                </label></p>
                                        </div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel2<?php echo $participante["id"] ?>" id="av1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Avanzado")>
                                                    <span>Avanzado</span>
                                                </label></p>
                                        </div>
                                        <div class="col s12 m2">
                                            <p><label>
                                                    <input type="radio" class="with-gap" name="nivel2<?php echo $participante["id"] ?>" id="e1<?php echo $participante["id"] ?>" onclick=actual(<?php echo $participante["id"] ?>,"Experto")>
                                                    <span>Experto</span>
                                                </label></p>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="denominacion" name="denominacion">
                        <label for="denominacion">Denominación</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="meta" id="meta">
                        <label for="meta">Meta Asociada</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="area" id="area">
                        <label for="area">Área de Conocimiento</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                        <input type="password" name="clave" id="clave">
                        <label for="clave">Ingrese su clave de seguridad</label>
                    </div>
                    <div class="input-field col s12">
                        <button class="btn-entrar" id="btn-submit" type="submit">Enviar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </form>
            </div>
            <p class="parrafo"><i class="material-icons left">error</i>
                Debe marcar por cada participante, el nivel actual que este posee y el nivel requerido,
                luego de indicar esto puede tildar el nombre del funcionario</p>

        </div>
    </div>
</div>


<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>
<script>
    var json = Array()

    function marcado(id) {
        if ($("#user" + id).prop('checked')) {
            var requerido = "",
                actual = "";
            if ($("#c" + id).prop('checked'))
                requerido = "Conoce"
            else if ($("#a" + id).prop('checked'))
                requerido = "Aplica"
            else if ($("#d" + id).prop('checked'))
                requerido = "Domina"
            else if ($("#av" + id).prop('checked'))
                requerido = "Avanzado"
            else if ($("#e" + id).prop('checked'))
                requerido = "Experto"
            if ($("#c1" + id).prop('checked'))
                actual = "Conoce"
            else if ($("#a1" + id).prop('checked'))
                actual = "Aplica"
            else if ($("#d1" + id).prop('checked'))
                actual = "Domina"
            else if ($("#av1" + id).prop('checked'))
                actual = "Avanzado"
            else if ($("#e1" + id).prop('checked'))
                actual = "Experto"

            if (requerido != "" && actual != "") {
                json.push([id, requerido, actual])
                console.log(json)
            } else {
                M.toast({
                    html: "Debe seleccionar el nivel requerido y actual del empleado",
                    classes: 'rounded red'
                })
                $("#user" + id).prop('checked', false)
            }
        } else {
            var pos = json.indexOf(id)
            json.splice(pos, 1)
        }
    }

    function requerido(id, nivel) {
        json.forEach(element => {
            if (element[0] == id) {
                element[1] = nivel
            }
        });
    }

    function actual(id, nivel) {
        json.forEach(element => {
            if (element[0] == id) {
                element[2] = nivel
            }
        });
    }

    function visualizar() {
        var pass = document.getElementById("clave");
        var icon = document.getElementById("icon");

        if (pass.getAttribute("type", "password") == "password") {
            pass.setAttribute("type", "text")
            icon.innerHTML = "visibility_off"
        } else {
            pass.setAttribute("type", "password")
            icon.innerHTML = "visibility"
        }
    }

    $('#form').submit(function(e) {
        if (json.length > 0) {
            $("#progress").css("display", "block")
            $("#btn-submit").prop("disabled", true)
            $("#btn-submit").css("background-color", "gray")
            var formData = new FormData(document.getElementById("form"));
            formData.append('array', JSON.stringify(json));
            $.ajax({
                type: "POST",
                url: 'solicitar_adiestramiento',
                data: formData,
                enctype: 'application/x-www-form-urlencoded',
                processData: false, // tell jQuery not to process the data
                contentType: false,
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                        location.href = "";
                    } else {
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                        $("#progress").css("display", "none")
                        $("#btn-submit").prop("disabled", false)
                        $("#btn-submit").css("background-color", "#1a237e")
                    }
                }
            });
            e.preventDefault();
        } else {
            M.toast({
                html: "Debe añadir algún participante",
                classes: 'rounded red'
            })
            $("#progress").css("display", "none")
            $("#btn-submit").prop("disabled", false)
            $("#btn-submit").css("background-color", "#1a237e")
        }
        e.preventDefault();
    });
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>