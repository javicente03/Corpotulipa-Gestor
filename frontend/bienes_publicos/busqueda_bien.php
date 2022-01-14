<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");
?>

<div class="container section">
    <div class="row">
        <h5 class="title">Realice su búsqueda</h5>
        <form id="form">
        <div class="col s12 m9 input-field blue lighten-5" style="border-radius:2em;">
            <i class="material-icons prefix">search</i>
            <input type="search" name="bien" id="bien">
        </div>
        <div class="input-field col s12 m3">
            <select name="departamento" id="departamento">
                <option value="0">General</option>
                <?php
                while($d = $departamentos->fetch_assoc()){
                    echo "<option value='".$d["departamento_id"]."'>".$d["siglas"]."</option>";
                }
                ?>
            </select>
        </div>
        <div class="input-field col s12">
            <button class="btn-entrar" id="btn-submit">Buscar</button>
        </div>
        </form>
        <table id="tabla" style="visibility: hidden;" class="striped z-depth-3 centered blue lighten-4">
            <thead class="table-head">
                <th>Código</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Responsable</th>
                <th>Departamento</th>
                <th>Solicitar</th>
            </thead>
            <tbody id="bienes">
                    
            </tbody>
        </table>
    </div>
</div>
<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>
    <script>
    

        $('#form').submit(function(e) {
            $("#tabla").css("visibility", "visible")
            document.getElementById("bienes").innerHTML =   `<tr>
                                                                <td>
                                                                    <div class="preloader-wrapper big active">
                                                                        <div class="spinner-layer spinner-red-only">
                                                                        <div class="circle-clipper left">
                                                                            <div class="circle"></div>
                                                                        </div><div class="gap-patch">
                                                                            <div class="circle"></div>
                                                                        </div><div class="circle-clipper right">
                                                                            <div class="circle"></div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>`
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'buscar_bien',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    document.getElementById("bienes").innerHTML = response
                }
            });
        });
    </script>
</body>
</html>