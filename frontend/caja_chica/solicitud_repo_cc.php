<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Solicitud de Reposición de Caja Chica</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="frontend/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            
            <div class="col s12 m4 input-field">
                <i class="material-icons prefix">edit</i>
                <label for="nro"> Nro. Reposición</label>
                <input type="text" id="nro">
            </div>
            <div class="col s12 m4 input-field">
                <i class="material-icons prefix">event</i>
                <label for="mes">Mes</label>
                <input type="text" id="mes">
            </div>
            <div class="col s12 m4 input-field">
                <i class="material-icons prefix">date_range</i>
                <label for="fecha">Fecha de emisión de la relación</label>
                <input type="text" id="fecha">
            </div>
            <div class="col s12 m4 input-field">
                <i class="material-icons prefix">grain</i>
                <label for="monto">Monto base del fondo</label>
                <input type="text" id="monto">
            </div>
            <div class="col s12 m4 input-field">
                <i class="material-icons prefix">library_books</i>
                <label for="factura_number">Nro. Comprobantes y facturas</label>
                <input type="text" id="factura_number">
            </div>
            <div class="col s12 m4 input-field">
                <i class="material-icons prefix">account_balance_wallet</i>
                <label for="factura_number">Total desembolso</label>
                <input type="text" id="factura_number">
            </div>
            <div class="col s12 m4 input-field">
                <i class="material-icons prefix">account_balance</i>
                <label for="factura_number">Efectivo en caja</label>
                <input type="text" id="factura_number">
            </div>
            <div class="col s12 m4 input-field">
                <i class="material-icons prefix">check</i>
                <label for="factura_number">Comprobación</label>
                <input type="text" id="factura_number">
            </div>
        </div>

        <table>
            <thead>
                <thead>
                    <tr>
                        <th>Solicitante</th>
                        <th>Bs</th>
                        <th>UT</th>
                        <th>Unidad</th>
                        <th>Fecha</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
            </thead>
            <tbody>
            <?php
                while($data = $solicitudes->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $data['nombre']." ".$data['apellido'] ?></td>
                    <td><?php echo $data['bs'] ?></td>
                    <td><?php echo $data['ut_pedido'] ?></td>
                    <td><?php echo $data['departamento'] ?></td>
                    <td><?php echo $data['fecha'] ?></td>
                    <td><?php echo $data['motivo'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
        <p>Fondo Actual: <?php echo $cc['fondo_actual'] ?></p>
        <form id="form">
            <input type="text" name="clave">
            <input type="hidden" name="monto" value="<?php echo $cc['fondo_actual'] ?>">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="frontend/js/materialize.min.js"></script>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>

        //Inicializacion de datepicker
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems,
                options = {
                    defaultDate: new Date(2021, 1, 3),
                    setDefaultDate: true
                }
            );
        });

        //Inicializacion de select
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, options);
        });

        $('#form').submit(function(e) {
            var formData = new FormData(document.getElementById("form"));
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'solicitud_repo_cc',
                data: formData,
                enctype:'application/x-www-form-urlencoded',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href=""
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>

</html>