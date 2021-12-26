<?php
$router=0;
include("backend/bd.php");
$total_valor = $bd->query("SELECT SUM(valor) FROM inventario_data ID LEFT JOIN bienes_publicos B ON ID.id_bien = B.id_bien WHERE id_inventario_departamento =12");
$a= $total_valor->fetch_assoc();
echo $a["SUM(valor)"];
echo "AAA";