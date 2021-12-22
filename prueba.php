<?php
$router=0;
include("backend/bd.php");
$gerentes = $bd->query("SELECT * FROM perfil P INNER JOIN usuario U ON P.id_usuario=U.id
                        LEFT JOIN cargo C ON P.cargo_id=C.cargo_id WHERE C.cargo = 'Gerente'");

while ($gerente = $gerentes->fetch_assoc()) {
    echo "A";
}