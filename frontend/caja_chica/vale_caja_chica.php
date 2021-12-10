<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Vale de Caja Chica</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="frontend/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <?php
        if(!isset($router))
            header("Location: ../../404");
    ?>
    <div class="container">
        <div class="container" style="border: solid black 1px; border-radius: .5em;">


            <div class="row">
                <form id="form">
                    <div class="col s12 input-field">
                        <i class="material-icons prefix">edit</i>
                        <label for="nombre">Vale de caja chica a nombre de:</label>
                        <input type="text" value="<?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ?>" disabled>
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
                        <input type="text" name="bs" id="bs">
                    </div>
                    <div class="col s12 input-field">
                        <i class="material-icons prefix">note</i>
                        <label for="motivo">Motivo del vale de caja:</label>
                        <textarea name="motivo" id="motivo" cols="30" rows="10" class="materialize-textarea"></textarea>
                    </div>
                    
                    <div class="col s12 center">
                        <button type="submit" class="btn green black-text waves-effect waves-light"
                            style="font-weight: bold; border-radius: .5em;"><i
                                class="material-icons left">send</i>Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <th>Fecha</th>
            <th>Bs</th>
            <th>UT</th>
            <th>Estado</th>
            <th>Acción</th>
        </thead>
        <tbody>
            <?php
                while($data = $ejecutar->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $data['fecha'] ?></td>
                <td><?php echo $data['bs'] ?></td>
                <td><?php echo $data['ut_pedido'] ?></td>
                <td>
                    <?php if($data['aprobado']){
                        echo "Aprobado";
                    } else {
                        echo "En Proceso";
                    } ?>
                </td>
                <td>
                <?php if($data['aprobado']){
                ?>
                    <a href="subir_factura_cc/<?php echo $data['id_sol_cc'] ?>">Subir Facturas</a>
                <?php }?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="frontend/js/materialize.min.js"></script>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>

        //Inicializacion de datepicker
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems,
                options = {
                    defaultDate: new Date(<?php echo $year.",".($month-1).",".$day ?>),
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
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'vale_chica',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>")
                        location.href = ""
                    else 
                        alert(response)
                }
            });
        });
    </script>
</body>

</html>