<?php
if(isset($router)){
    $prestamo = $_POST["tramite"];
    $clave = trim(addslashes($_POST["clave"]));
    $observacion = trim(addslashes($_POST["observacion"]));
    $year = date("Y");
    $year = substr($year,2,4);

    if($clave != ""){
        include("bd.php");

        $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
        if(password_verify($clave, $usuario['password'])){
            $tramite = ($bd->query("SELECT * FROM tramite_bienes WHERE id_prestamo_bien = $prestamo"))->fetch_assoc();
            
            if($tramite["concepto"] == "Traslado"){
                if($_SESSION["id"]==$tramite["user1"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET analista = true, analista2 = true WHERE id_prestamo_bien = $prestamo");
                }
                if($_SESSION["id"]==$tramite["user2"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET coordinador = true, coordinador2 = true WHERE id_prestamo_bien = $prestamo");
                }
                if($_SESSION["id"]==$tramite["user3"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET entregado = true, entregado2 = true WHERE id_prestamo_bien = $prestamo");
                }
                if($_SESSION["id"]==$tramite["user4"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET recibido = true, recibido2 = true WHERE id_prestamo_bien = $prestamo");
                }
                $tramiteNuevo = ($bd->query("SELECT * FROM tramite_bienes WHERE id_prestamo_bien = $prestamo"))->fetch_assoc();
                if($tramiteNuevo["analista"] && $tramiteNuevo["analista2"] &&
                    $tramiteNuevo["coordinador"] && $tramiteNuevo["coordinador2"] &&
                    $tramiteNuevo["entregado"] && $tramiteNuevo["entregado2"] &&
                    $tramiteNuevo["recibido"] && $tramiteNuevo["recibido2"]){
                        $date = date("Y-m-d");
                        $finalizar = $bd->query("UPDATE tramite_bienes SET fecha_fin_tramite = '$date' WHERE id_prestamo_bien = $prestamo");
                        $prestamoResponsable = ($bd->query("SELECT * FROM prestamo_bien T INNER JOIN bienes_publicos B
                                                            ON T.id_bien=B.id_bien WHERE id_prestamo_bien = $prestamo"))->fetch_assoc();
                        $solicitante = ($bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D 
                                                    ON P.departamento_id=D.departamento_id WHERE id = ".$prestamoResponsable["solicitante"]))->fetch_assoc();
                                                
                        $organismoU = $prestamoResponsable['organismo'];
                        $catalogoU = $prestamoResponsable['catalogo'];
                        $tipoU = $prestamoResponsable['tipo'];
                        $denoOrgaU = $prestamoResponsable['denoOrga'];
                        $depId = $solicitante['departamento_id'];
                        $denoDepaU = $prestamoResponsable['denoDepa'];
                        $dependenciaU = $prestamoResponsable['dependencia'];
                        $denoUsuU = $prestamoResponsable['denoUsu'];
                        $muebleU = $prestamoResponsable['nombre_bien'];
                        $descripcionU = $prestamoResponsable['descripcion'];
                        $incorpoU = $prestamoResponsable['incorporado_por'];
                        $solicitanteU = $solicitante['id'];
                        $valorU = $prestamoResponsable['valor'];
                        $catastroU = $prestamoResponsable['catastro'];
                        $bd->query("UPDATE bienes_publicos SET existente = false WHERE id_bien = ".$prestamoResponsable['id_bien']);
                        $bd->query("INSERT INTO bienes_publicos (codigo,catalogo,tipo,organismo,denoOrga,departamento_id,denoDepa,dependencia,denoUsu,nombre_bien,descripcion,fecha_incorporacion,incorporado_por,responsable,valor,catastro) 
                                                VALUES ('','$catalogoU','$tipoU','$organismoU','$denoOrgaU','$depId','$denoDepaU','$dependenciaU',
                                                        '$denoUsuU','$muebleU','$descripcionU','$date','$incorpoU', '$solicitanteU','$valorU','$catastroU')");
                        $anterior = ($bd->query("SELECT * FROM bienes_publicos ORDER BY id_bien DESC LIMIT 1")->fetch_assoc());
                        $anterior_id = $anterior["id_bien"];
                        $codigo = $solicitante["siglas"] . "-" . $year . "-" . $anterior_id;
                        $bd->query("UPDATE bienes_publicos SET codigo = '$codigo' WHERE id_bien = $anterior_id");

                        // $updateResponsable = $bd->query("UPDATE bienes_publicos SET responsable=".$tramite["user4"].
                                                        // ", codigo='$codigoNuevo' WHERE id_bien = ".$prestamoResponsable["id_bien"]);
                }
            } else {
            
            if($_SESSION["id"]==$tramite["user1"]){
                if(!$tramite["analista"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET analista = true WHERE id_prestamo_bien = $prestamo");
                } else {
                    $tramitar = $bd->query("UPDATE tramite_bienes SET analista2 = true WHERE id_prestamo_bien = $prestamo");
                }
            }
            if($_SESSION["id"]==$tramite["user2"]){
                if(!$tramite["coordinador"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET coordinador = true WHERE id_prestamo_bien = $prestamo");
                } else {
                    $tramitar = $bd->query("UPDATE tramite_bienes SET coordinador2 = true WHERE id_prestamo_bien = $prestamo");
                }
            }
            if($_SESSION["id"]==$tramite["user3"]){
                if(!$tramite["entregado"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET entregado = true WHERE id_prestamo_bien = $prestamo");
                } else {
                    $tramitar = $bd->query("UPDATE tramite_bienes SET entregado2 = true WHERE id_prestamo_bien = $prestamo");
                }
            }
            if($_SESSION["id"]==$tramite["user4"]){
                if(!$tramite["recibido"]){
                    $tramitar = $bd->query("UPDATE tramite_bienes SET recibido = true WHERE id_prestamo_bien = $prestamo");
                } else {
                    $tramitar = $bd->query("UPDATE tramite_bienes SET recibido2 = true WHERE id_prestamo_bien = $prestamo");
                }
            }

            $tramiteNuevo = ($bd->query("SELECT * FROM tramite_bienes WHERE id_prestamo_bien = $prestamo"))->fetch_assoc();
            if($tramiteNuevo["analista"] && $tramiteNuevo["analista2"] &&
                $tramiteNuevo["coordinador"] && $tramiteNuevo["coordinador2"] &&
                $tramiteNuevo["entregado"] && $tramiteNuevo["entregado2"] &&
                $tramiteNuevo["recibido"] && $tramiteNuevo["recibido2"]){
                    $date = date("Y-m-d");
                    $finalizar = $bd->query("UPDATE tramite_bienes SET fecha_fin_tramite = '$date'");
            }
            }

            if($observacion !=""){
                $bd->query("INSERT INTO observaciones_prestamo (id_prestamo_bien,texto,id_usuario) VALUES ('$prestamo','$observacion','".$_SESSION["id"]."')");
            }
            echo "ok";
        } else
            echo "Clave inválida";
    } else
        echo "Debe ingresar su clave de usuario para confirmar";
} else
    header("Location: ../404");