<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Editar UT Caja Chica</title>
</heads>
<body>
    <?php
        if(!isset($router))
            header("Location: ../../404");
    ?>

    <form id="form">
        <input type="file" name="factura" id="factura">
        <button type="submit">Subir</button>
        <input type="hidden" name="id" value="<?php echo $solicitud['id_sol_cc'] ?>">
    </form>
    
    <?php
        echo $solicitud['fecha']." ".$solicitud['bs']." ".$solicitud['ut_pedido'];
        while($img = $facturas->fetch_assoc()){
    ?>
        <img src="../<?php echo $img['factura'] ?>" alt="">
    <?php
        }
    ?>

    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            var formData = new FormData(document.getElementById("form"));
            formData.append('factura', $('#factura')[0].files[0]);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'subir_factura_cc',
                data: formData,
                enctype:'multipart/form-data',
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