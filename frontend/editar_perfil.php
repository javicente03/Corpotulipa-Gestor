<?php
include("frontend/modularizacion/encabezado_html.php");

if (!isset($router))
    header("Location: 404");
include("frontend/modularizacion/menu.php")
?>

<div class="container section">
    <div class="row cont-crear">
        <form id="form">
            <h5 class="title">Editar Perfil</h5>
            <div class="input-field col s12 m6">
                <input type="text" name="nombre" id="nombre" value="<?php echo $_SESSION['nombre'] ?>">
                <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12 m6">
                <input type="text" name="apellido" id="apellido" value="<?php echo $_SESSION['apellido'] ?>">
                <label for="apellido">Apellido</label>
            </div>
            <div class="input-field col s12 m6">
                <input type="email" name="email" id="email" value="<?php echo $_SESSION['email'] ?>">
                <label for="email">Correo Electrónico</label>
            </div>
            <div class="input-field col s12 m6">
                <div class="row">
                    <div class="col s12 m4">
                        <p>
                            <label>
                                <input type="radio" name="genero" id="masculino" value="Masculino" onclick="s(1)" <?php if ($_SESSION['genero'] == 'Masculino') echo "checked" ?>>
                                <span>Masculino</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s12 m4">
                        <p>
                            <label>
                                <input type="radio" name="genero" id="femenino" value="Femenino" onclick="s(1)" <?php if ($_SESSION['genero'] == 'Femenino') echo "checked" ?>>
                                <span>Femenino</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s12 m4">
                        <p>
                            <label>
                                <input type="radio" name="genero" id="otro" value="Otro" onclick="s(2)" <?php if ($_SESSION['genero'] != 'Masculino' && $_SESSION['genero'] != 'Femenino') echo "checked" ?>>
                                <span>Otro</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s12">
                        <input type="text" name="other" id="other" <?php if ($_SESSION['genero'] != 'Masculino' && $_SESSION['genero'] != 'Femenino') echo "value='" . $_SESSION['genero'] . "'";
                                                                    else echo "disabled"; ?>>
                    </div>
                </div>
            </div>
            <div class="file-field input-field col s12 m6">
                <div class="btn indigo darken-4">
                    <span><i class="material-icons">add_a_photo</i></span>
                    <input type="file" name="img" id="img">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field col s12 m6">
                <input type="date" name="nacimiento" id="nacimiento" value="<?php echo $_SESSION['birthday'] ?>">
            </div>
            <div class="col s12 m6" style="display: flex;justify-content: center;">
                <img class="materialboxed img-perfil responsive-img" src="<?php echo $_SESSION['img'] ?>" alt="" id="image">
            </div>
            <div class="input-field col s12 m6">
                <button type="submit" class="btn-entrar" id="btn-submit">Editar</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="row" style="border: #040729 solid 3px; padding: 10px;border-radius: 1em;">
        <form id="form2">
            <h5 class="title">Cambie su contraseña</h5>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix" onclick="visualizar()" id="icon-password" style="cursor: pointer;">visibility</i>
                <input type="password" name="old" id="old">
                <label for="old">Ingrese su Antigua Contraseña</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix" onclick="visualizar()" id="icon-password2" style="cursor: pointer;">visibility</i>
                <input type="password" name="new" id="new">
                <label for="new">Ingrese su nueva contraseña</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix" onclick="visualizar()" id="icon-password3" style="cursor: pointer;">visibility</i>
                <input type="password" name="confirm" id="confirm">
                <label for="confirm">Confirme su contraseña</label>
            </div>
            <div class="input-field col s12 m6">
                <button type="submit" class="btn-entrar" id="btn-password">Cambiar</button>
            </div>
            <div class="progress indigo darken-4" id="progress2" style="display: none;">
                    <div class="indeterminate"></div>
            </div>
        </form>
    </div>
</div>

<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>

<script>
    function s(i) {
        if (i == 1) {
            document.getElementById("other").disabled = true
            document.getElementById("other").value = ""
            document.getElementById("other").placeholder = ""
        } else {
            document.getElementById("other").disabled = false
            document.getElementById("other").placeholder = "Ingrese un genero"
        }
    }

    function visualizar() {
        var pass = document.getElementById("old");
        var icon = document.getElementById("icon-password");
        var pass2 = document.getElementById("new");
        var icon2 = document.getElementById("icon-password2");
        var pass3 = document.getElementById("confirm");
        var icon3 = document.getElementById("icon-password3");

        if (pass.getAttribute("type", "password") == "password") {
            pass.setAttribute("type", "text")
            icon.innerHTML = "visibility_off"
            pass2.setAttribute("type", "text")
            icon2.innerHTML = "visibility_off"
            pass3.setAttribute("type", "text")
            icon3.innerHTML = "visibility_off"
        } else {
            pass.setAttribute("type", "password")
            icon.innerHTML = "visibility"
            pass2.setAttribute("type", "password")
            icon2.innerHTML = "visibility"
            pass3.setAttribute("type", "password")
            icon3.innerHTML = "visibility"
        }
    }

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop("disabled", true)
        $("#btn-submit").css("background-color", "gray")
        var formData = new FormData(document.getElementById("form"));
        formData.append('img', $('#img')[0].files[0]);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'editar_perfil',
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
                    $("#btn-submit").prop("disabled", false)
                    $("#btn-submit").css("background-color", "#1a237e")
                }
            }
        });
    });

    $('#form2').submit(function(e) {
        $("#progress2").css("display", "block")
        $("#btn-password").prop("disabled", true)
        $("#btn-password").css("background-color", "gray")
        var formData = new FormData(document.getElementById("form2"));
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'password',
            data: formData,
            enctype: 'application/x-www-form-urlencoded',
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response) {
                if (response == "ok") {
                    M.toast({
                        html: response,
                        classes: 'rounded green'
                    })
                    setTimeout(() => {
                        location.href = "logout"
                    }, 3000);
                } else if (response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = ""
                } else {
                    M.toast({
                        html: response,
                        classes: 'rounded red'
                    })
                    $("#progress2").css("display", "none")
                    $("#btn-password").prop("disabled", false)
                    $("#btn-password").css("background-color", "#1a237e")
                }
            }
        });
    });

    const $seleccionArchivos = document.querySelector("#img"),
        $imagenPrevisualizacion = document.querySelector("#image");

    // Escuchar cuando cambie
    $seleccionArchivos.addEventListener("change", () => {
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $seleccionArchivos.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $imagenPrevisualizacion.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $imagenPrevisualizacion.src = objectURL;
    });
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>