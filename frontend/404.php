<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - 404 Page Not Found</title>
</head>
<body>
    <?php 
        if(!isset($router)) 
            header("Location: ../404");
    ?>
    <h2>404 PAGE NOT FOUND :(</h2> 
</body>
</html>