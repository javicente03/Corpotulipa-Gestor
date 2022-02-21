<?php
if(isset($_SESSION['id'])){
    include("bd.php");
    $Object = new DateTime();
	$Object->setTimezone(new DateTimeZone('America/Caracas'));
	$hora = $Object->format("H:i:s");
	$fecha = $Object->format("Y-m-d");
    $bd->query("UPDATE usuario SET ult_hora = '$hora', ult_fecha = '$fecha' WHERE id = ".$_SESSION["id"]);
    session_destroy();
}
header("Location: login");