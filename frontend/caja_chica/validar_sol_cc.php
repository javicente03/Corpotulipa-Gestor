<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");
?>
    <div class="container section">
            <h5 class="title title-table">Validar Solicitudes de Caja Chica</h5>
            <table class="striped responsive-table z-depth-3 centered" id="tabla">
                <thead class="table-head">
                    <th>Solicitante</th>
                    <th>Monto en Bs</th>
                    <th>Unidades Tributarias</th>
                    <th>Fecha de la solicitud</th>
                    <th>Motivo</th>
                    <th>Ver Facturas</th>
                    <th>Acción</th>
                </thead>
                <tbody>
                <?php
                    while($data = $ejecutar->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $data['nombre'] ?></td>
                        <td><?php echo $data['bs'] ?></td>
                        <td><?php echo $data['ut_pedido'] ?></td>
                        <td><?php echo $data['fecha'] ?></td>
                        <td><div class="scroll-td" style="width: 300px;"><?php echo $data['motivo'] ?></div></td>
                        <td><button class="btn btn-flat" onclick="facturas(<?php echo $data['id_sol_cc'] ?>)">
                            <i class="material-icons">collections</i></button</td>
                        <td><button title="Validar Solicitud" class="btn indigo darken-3" onclick="aceptar(<?php echo $data['id_sol_cc'] ?>)">
                            <i class="material-icons">check</i></button></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        <div class="section" id="img-contenedor"><div id="imgs" class="row"></div></div>
    </div>
    
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script src="frontend/js/materialize.min.js"></script>
    <script src="frontend/js/elementos-materialize.js"></script>
    <script src="frontend/js/datatables.min.js"></script>
    <script src="frontend/js/notificaciones.js"></script>

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
        
            $(document).ready(function(){
    $('.materialboxed').materialbox();
  });

        function aceptar(id){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'validar_sol_cc',
                data: {id:id},
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>")
                        location.href = ""
                    else 
                        alert(response)
                }
            });
        }

        function facturas(id){
            var cont = document.getElementById("img-contenedor"),
                imgs = document.getElementById("imgs");
            cont.removeChild(imgs)
            preloader = `<div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                        </div>
                    </div>`,
            nodo = document.createElement("div");
            nodo.innerHTML = preloader
            nodo.id="nodo"
            cont.appendChild(nodo)
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: 'validar_sol_cc',
                data: {id:id,factura:1},
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                        cont.removeChild(nodo)
                    var data = JSON.parse(response);
                        newImgs = document.createElement("div");
                    newImgs.className = "row cont-crear"
                    newImgs.id = "imgs"
                    h5 = document.createElement("h5")
                    h5Text = document.createTextNode("Facturas Relacionadas")
                    h5.className = "title"
                    h5.appendChild(h5Text)
                    newImgs.appendChild(h5)
                    data.forEach(e => {
                        var col = document.createElement("div"),
                            image = document.createElement("img");
                        col.className = "col s12 m6"
                        col.style = "margin:4px 0"
                        image.className = "materialboxed responsive-img"
                        image.src = e.factura
                        col.appendChild(image)
                        newImgs.appendChild(col)
                    });
                    cont.appendChild(newImgs)
                }
            });
        }

    </script>    
<?php
    include("frontend/modularizacion/cierre_html.php");
?>