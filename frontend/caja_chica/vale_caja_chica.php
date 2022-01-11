<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>

<div class="container section">
    <div class="row cont-crear">
        <form id="form">
            <h5 class="title" style="text-align: center;">Vale de Caja Chica</h5>
            <div class="col s12 input-field">
                <i class="material-icons prefix">edit</i>
                <label for="nombre">Vale de caja chica a nombre de:</label>
                <input type="text" value="<?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?>" disabled>
            </div>
            <div class="col s12 input-field">
                <i class="material-icons prefix">business</i>
                <input type="text" disabled value="<?php echo $_SESSION['departamento'] ?>">
            </div>
            <div class="col s12 m6 input-field">
                <i class="material-icons prefix">event</i>
                <label for="fecha">Fecha:</label>
                <input type="text" class="datepicker" disabled>
            </div>
            <div class="col s12 m6 input-field">
                <i class="material-icons prefix">grain</i>
                <label for="bs">Bs:</label>
                <input type="number" name="bs" id="bs" class="validate" required>
                <span class="helper-text" data-error="Debe completar este campo numérico" data-success=""></span>
            </div>
            <div class="col s12 input-field">
                <i class="material-icons prefix">note</i>
                <label for="motivo">Motivo del vale de caja:</label>
                <textarea name="motivo" id="motivo" data-length="2000" class="materialize-textarea"></textarea>
            </div>

            <div class="col s12 center">
                <button type="submit" class="btn-entrar" id="btn-submit">Solicitar</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </form>
        <div class="col s12" style="margin-top: 20px;">
            <h5 class="title title-table">Tus solicitudes pendientes</h5>
            <table id="tabla" class="striped responsive-table z-depth-3 centered">
                <thead class="table-head">
                    <th>Fecha</th>
                    <th>Bs</th>
                    <th>UT</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </thead>
                <tbody>
                    <?php
                    while ($data = $ejecutar->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $data['fecha'] ?></td>
                            <td><b><?php echo $data['bs'] ?></b></td>
                            <td><?php echo $data['ut_pedido'] ?></td>
                            <td><b>
                                <?php if ($data['aprobado']) {
                                    echo "Aprobado";
                                } else {
                                    echo "En Proceso";
                                } ?>
                            </b></td>
                            <td>
                                <?php if ($data['aprobado']) {
                                ?>
                                    <a href="subir_factura_cc/<?php echo $data['id_sol_cc'] ?>" class="btn btn-flat"><i class="material-icons">collections</i>Facturas</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p class="parrafo">
                <i class="material-icons left">error</i>
                Debes esperar que tus solicitudes hayan sido aprobadas para cargar las facturas correpondientes</p>
        </div>
    </div>
    
</div>

<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>
<script src="frontend/js/datatables.min.js"></script>

<script>

    //Inicializacion de datepicker
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems,
            options = {
                defaultDate: new Date(<?php echo $year . "," . ($month - 1) . "," . $day ?>),
                setDefaultDate: true
            }
        );
    });

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

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'vale_chica',
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