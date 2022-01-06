<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>

<div class="container section">
    <div class="row">
        <form id="form">

            <h5 class="title">Crear Nuevo Cargo</h5>
            <div class="col s12 m6 input-field">
                <input type="number" name="rango" id="rango">
                <label for="rango">Rango</label>
            </div>
            <div class="col s12 m6 input-field">
                <input type="text" name="nombre" id="nombre">
                <label for="nombre">Nombre del Cargo</label>
            </div>
            <div class="col s12 input-field">
                <button type="submit" id="btn-submit" class="btn-entrar">Crear</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </form>
        <div class="col s12">
            <h5 class="title title-table">Cargos Existentes</h5>
            <table id="tabla" class="striped responsive-table z-depth-3 centered">
                <thead class="table-head">
                    <th>Rango</th>
                    <th>Nombre</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </thead>
                <tbody>
                    <?php
                    while ($data = $proceso->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $data["rango"] ?></td>
                            <td><b><?php echo $data["cargo"] ?></b></td>
                            <td><a href="editar_cargo/<?php echo $data["cargo_id"]; ?>" class="btn btn-flat indigo-text text-darken-4" style="font-weight: bold;">
                                    <i class="material-icons">edit</i></a></td>
                            <td><button type="button" class="btn pink darken-4 waves-effect waves-light" onclick="eliminar(<?php echo $data['cargo_id'] ?>)">
                                    <i class="material-icons">delete</i></button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/datatables.min.js"></script>

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

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'cargos',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok") {
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

    function eliminar(id) {
        option = confirm("¿Seguro desea eliminar este cargo?");
        if (option) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'eliminar_cargo',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                        location.href = ""
                    } else {
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                    }
                }
            });
        }
    }
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>