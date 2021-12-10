<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Iniciar Sesión</title>
</heads>
<body>
    <a href="logout">Salir</a>
    <h1><?php 
    echo $_SESSION['nombre']." ".$_SESSION['apellido']." ".$_SESSION['email'];
    $ca1 = "javileon03";
    $ca2 = "ojavileon";
    $str = strpos($ca1,$ca2);
    $str2 = strpos($ca2,$ca1);
    echo $str;
    echo $str2;
    if($str !== false || $str2 !== false)
        echo "si";
    else
        echo "No";
    
    ?></h1>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>   
</body>
</html>