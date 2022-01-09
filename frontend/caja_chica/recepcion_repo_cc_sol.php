<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="container section">
    <div class="row">
        <h5 class="title title-table">Solicitudes de caja chica relacionadas</h5>
        <table id="tabla" class="stripped responsive-table z-depth-3 centered">
            <thead class="table-head">
                        <th>Fecha</th>
                        <th>Bs</span></th>
                        <th>UT</th>
                        <th>Motivo</th>
                        <th>Facturas</th>
                        <th>Total Bs</th>
                        <th>Total UT</th>
            </thead>
            <tbody>
            <?php
                while($data = $solicitudes->fetch_assoc()){
                    $bs += $data['bs'];
                    $ut += $data['ut_pedido'];
                ?>
                <tr>
                    <td><?php echo $data['fecha'] ?></td>
                    <td><?php echo $data['bs'] ?></td>
                    <td><?php echo $data['ut_pedido'] ?></td>
                    <td><div class="scroll-td"><?php echo $data['motivo'] ?></div></td>
                    <td><button onclick="facturas(<?php echo $data['id_sol_cc'] ?>)">Facturas</button</td>
                    <td></td>
                    <td></td>
                    
                </tr>
            <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $bs ?></td>
                    <td><?php echo $ut ?></td>
                </tr>
            </tbody>
        </table>
        <div style="display: flex;justify-content: center;">
            <div class="cont-caja-chica">
                <h4 class="title" style="text-align: center;">Fondo Actual de Caja Chica</h4>
                <h3 class="title" style="text-align: center;"><?php echo $cc['fondo_actual'] ?> <small>UT</small></h3>
            </div>
        </div>
        <div class="row">
            <form id="form">
                <h5 class="title">Aprobar Solicitud</h5>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                    <input type="text" name="clave" id="clave">
                    <label for="clave">Ingrese su clave de seguridad</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="hidden" name="id" value="<?php echo $router->getParam() ?>">
                    <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                    <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
    
        
            
        <form id="form2">
            <input type="text" name="clave">
            <input type="text" name="motivo">
            <select name="cargo">
                <?php
                    while($cargo=$cargos->fetch_assoc()){
                        echo "<option value='".$cargo['cargo_id']."'>".$cargo['cargo']."</option>";
                    }
                ?>
            </select>
            <input type="hidden" name="id" value="<?php echo $router->getParam() ?>">
            <button type="submit">Enviar</button>
        </form>
        <div id="imgs">
        </div>
                    
        <script src="../frontend/js/jquery-3.6.0.min.js"></script>
        <script src="../frontend/js/materialize.min.js"></script>
        <script src="../frontend/js/elementos-materialize.js"></script>
        <script src="../frontend/js/notificaciones-page.js"></script>
        <script src="../frontend/js/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No hay data registrada",
                    "info": "Total: _MAX_ resultados",
                    "infoEmpty": "No hay coincidencias",
                    "infoFiltered": "",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            }); 
        });

        function visualizar() {
            var pass = document.getElementById("clave");
            var icon = document.getElementById("icon-password");

            if (pass.getAttribute("type", "password") == "password") {
                pass.setAttribute("type", "text")
                icon.innerHTML = "visibility_off"
            } else {
                pass.setAttribute("type", "password")
                icon.innerHTML = "visibility"
            }
        }
        function facturas(id){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'recepcion_repo_cc',
                data: {id:id,factura:1},
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    document.getElementById("imgs").innerHTML = response
                }
            });
        }

        $('#form').submit(function(e) {
            var formData = new FormData(document.getElementById("form"));
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'recepcion_repo_cc',
                data: formData,
                enctype:'application/x-www-form-urlencoded',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href="../recepcion_repo_cc/"
                    } else {
                        alert(response)
                    }
                }
            });
        });

        $('#form2').submit(function(e) {
            var formData = new FormData(document.getElementById("form2"));
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'recepcion_repo_cc',
                data: formData,
                enctype:'application/x-www-form-urlencoded',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href="../recepcion_repo_cc/"
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>