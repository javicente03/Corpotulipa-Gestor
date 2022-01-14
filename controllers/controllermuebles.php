<?php

class ControllersMueble{
    public function incorporarMueble($router){
        include("backend/bd.php");
        $departamentos = $bd->query("SELECT * FROM departamento");
        $usuarios = $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON U.id = P.id_usuario 
                                LEFT JOIN cargo C ON P.cargo_id=C.cargo_id");
        return include("frontend/bienes_publicos/incorporacion_bien.php");
    }

    public function generarNota($router){
        include("backend/bd.php");
        if (!empty($router->getParam())){
            $bien = ($bd->query("SELECT * FROM bienes_publicos B INNER JOIN departamento D ON B.departamento_id = D.departamento_id
                                LEFT JOIN usuario U ON B.responsable=U.id INNER JOIN perfil P ON U.id = P.id_usuario 
                                WHERE id_bien = ".$router->getParam()))->fetch_assoc();
            $usuarios = $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON U.id = P.id_usuario");
            $usuarios2 = $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON U.id = P.id_usuario");
            $usuarios3 = $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON U.id = P.id_usuario");

            if($bien)
                return include("frontend/bienes_publicos/generar_nota_entrega.php");
            else
                header("Location: ../404");
        } else {
            $bienes = $bd->query("SELECT * FROM verificacion_bienes V INNER JOIN bienes_publicos B
                                LEFT JOIN usuario U ON B.responsable=U.id INNER JOIN perfil P ON U.id = P.id_usuario
                                ON V.id_bien=B.id_bien WHERE user1 IS NULL OR user2 IS NULL OR user3 IS NULL");

            return include("frontend/bienes_publicos/bienes_sin_nota.php");
        }
    }

    public function verificarBien($router){
        include("backend/bd.php");
        $bien = ($bd->query("SELECT * FROM verificacion_bienes V INNER JOIN bienes_publicos B ON V.id_bien=B.id_bien 
                            LEFT JOIN usuario U ON B.responsable=U.id INNER JOIN perfil P ON U.id = P.id_usuario
                            INNER JOIN departamento D ON B.departamento_id=D.departamento_id 
                            WHERE V.id_bien = ".$router->getParam()))->fetch_assoc();

        if($bien){
            $revision=False;
            $verificacion=False;
            $validacion=False;
            if($_SESSION["id"] == $bien["user1"])
                $revision = True;
            if($_SESSION["id"] == $bien["user2"])
                $verificacion = True;
            if($_SESSION["id"] == $bien["user3"])
                $validacion = True;
            if(!$revision && !$verificacion && !$validacion)
                header("Location: ../404");
            return include("frontend/bienes_publicos/verificar_bien.php");
        } else
            header("Location: ../404");
    }

    public function misBienes($router){
        include("backend/bd.php");
        if(empty($router->getParam())){
            // $bienes = $bd->query("SELECT *, MAX(P.fecha_prestamo) FROM bienes_publicos B 
            //                     LEFT JOIN prestamo_bien P ON B.id_bien=P.id_bien AND P.aprobado = true
            //                     WHERE B.responsable = ".$_SESSION["id"]." AND existente = true 
            //                     GROUP BY B.id_bien");
            $bienes = $bd->query("SELECT * FROM bienes_publicos WHERE responsable = ".$_SESSION["id"]." AND existente = true");
            return include("frontend/bienes_publicos/mis_bienes.php");
        } else {
            $bien = ($bd->query("SELECT * FROM bienes_publicos WHERE id_bien = ".$router->getParam())->fetch_assoc());
            if(!$bien)
                header("Location: ../404");
            if($bien["responsable"] != $_SESSION["id"])
                header("Location: ../404");
            
            $prestado = ($bd->query("SELECT *, DATE_ADD(fecha_prestamo, INTERVAL duracion DAY) 
                                    FROM prestamo_bien T LEFT JOIN usuario U ON T.solicitante=U.id
                                    LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D ON
                                    P.departamento_id=D.departamento_id WHERE T.id_bien=".$router->getParam().
                                    " ORDER BY id_prestamo_bien 
                                    DESC LIMIT 1"))->fetch_assoc();
            if($prestado)
                $fecha = $prestado["DATE_ADD(fecha_prestamo, INTERVAL duracion DAY)"];
            return include("frontend/bienes_publicos/mi_bien.php");
        }
    }

    public function buscarBien($router){
        include("backend/bd.php");
        $departamentos = $bd->query("SELECT * FROM departamento");
        return include("frontend/bienes_publicos/busqueda_bien.php");
    }

    public function prestarBien($router){
        include("backend/bd.php");
        $bien = ($bd->query("SELECT * FROM bienes_publicos B LEFT JOIN usuario U ON B.responsable=U.id LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D ON P.departamento_id=D.departamento_id WHERE id_bien = ".$router->getParam()))->fetch_assoc();
        if(!$bien)
            header("Location: ../404");
        if($bien["responsable"] == null)
            header("Location: ../404"); 
        return include("frontend/bienes_publicos/prestamo_bien.php");
    }

    public function revisarPrestamoBien($router){
        include("backend/bd.php");
        $prestamo = ($bd->query("SELECT * FROM prestamo_bien T LEFT JOIN bienes_publicos B ON 
                                T.id_bien=B.id_bien LEFT JOIN usuario U ON T.solicitante=U.id 
                                LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D 
                                ON P.departamento_id=D.departamento_id 
                                WHERE id_prestamo_bien = ".$router->getParam()))->fetch_assoc();
        if(!$prestamo)
            header("Location: ../404");
        if($prestamo["responsable"] != $_SESSION["id"])
            header("Location: ../404");
        if($prestamo["aprobado"] || $prestamo["rechazado"])
            header("Location: ../404");
        return include("frontend/bienes_publicos/revisar_prestamo.php");
    }

    public function movimientosBienes($router){
        include("backend/bd.php");
        if(empty($router->getParam())){ //Revisa que haya algun parametro
            $sql = "SELECT * FROM permisos WHERE accion = 'Movimiento_Bienes' AND cargo_id =".$_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if($query->num_rows > 0){ //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción    
                $prestamos = $bd->query("SELECT * FROM prestamo_bien T LEFT JOIN bienes_publicos B ON 
                                        T.id_bien=B.id_bien LEFT JOIN usuario U ON T.solicitante=U.id 
                                        LEFT JOIN perfil P ON U.id=P.id_usuario WHERE aprobado = true AND 
                                        tramitado = false");
                return include("frontend/bienes_publicos/movimientos_bienes.php");
            } else
                header("Location: 404");
        } else{
            $sql = "SELECT * FROM permisos WHERE accion = 'Movimiento_Bienes' AND cargo_id =".$_SESSION['cargo_id'];
            $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
            if($query->num_rows > 0){ //Si hay al menos un resultado el permiso esta dado a este cargo en referencia a esta acción    
                $analista = ($bd->query("SELECT * FROM tramite_bienes WHERE id_prestamo_bien = ".$router->getParam()))->fetch_assoc();
                if(!$analista){
                    $prestamo = ($bd->query("SELECT * FROM prestamo_bien T LEFT JOIN usuario U ON T.solicitante=U.id 
                                            LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D 
                                            ON P.departamento_id=D.departamento_id WHERE aprobado = true AND 
                                            tramitado = false AND id_prestamo_bien = ".$router->getParam()))->fetch_assoc();
                    
                    if(!$prestamo)
                        header("Location: ../404");

                    $responsable = ($bd->query("SELECT * FROM bienes_publicos B LEFT JOIN usuario U ON B.responsable=U.id 
                                                LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D 
                                                ON P.departamento_id=D.departamento_id WHERE id_bien = ".$prestamo["id_bien"]))->fetch_assoc();
                    
                    $usuarios =  $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON U.id=P.id_usuario
                                            LEFT JOIN cargo C ON P.cargo_id=C.cargo_id");
                    
                    return include("frontend/bienes_publicos/movimiento_bien.php");
                } else {
                    $prestamo = ($bd->query("SELECT * FROM prestamo_bien T INNER JOIN bienes_publicos B
                                            ON T.id_bien=B.id_bien WHERE id_prestamo_bien = ".$router->getParam()))->fetch_assoc();
                    return include("frontend/bienes_publicos/tramite_bien.php");
                }
            } else {
                $tramite = ($bd->query("SELECT * FROM tramite_bienes WHERE id_prestamo_bien = ".$router->getParam()))->fetch_assoc();
                $prestamo = ($bd->query("SELECT * FROM prestamo_bien T INNER JOIN bienes_publicos B
                                        ON T.id_bien=B.id_bien WHERE id_prestamo_bien = ".$router->getParam()))->fetch_assoc(); 

                if($tramite["user2"]==$_SESSION["id"] || $tramite["user3"]==$_SESSION["id"] || $tramite["user4"]==$_SESSION["id"]){
                        if($tramite["fecha_fin_tramite"] == null ){
                            return include("frontend/bienes_publicos/tramite_bien.php");
                        } else
                            header("Location: ../404");
                    } else
                        header("Location: ../404");
            }
        }  
    }

    public function bienesPrestados($router){
        include("backend/bd.php");
        if(empty($router->getParam())){
            $prestamos = $bd->query("SELECT * FROM tramite_bienes R LEFT JOIN prestamo_bien T ON
                                    R.id_prestamo_bien=T.id_prestamo_bien LEFT JOIN bienes_publicos B ON 
                                    T.id_bien=B.id_bien LEFT JOIN usuario U ON B.responsable=U.id 
                                    LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D 
                                    ON P.departamento_id=D.departamento_id 
                                    WHERE fecha_fin_tramite IS NULL AND user4 = ".$_SESSION["id"]);
            
            return include("frontend/bienes_publicos/bienes_prestados.php");
        } else {
            $prestamo = ($bd->query("SELECT * FROM tramite_bienes R LEFT JOIN prestamo_bien T ON
                                    R.id_prestamo_bien=T.id_prestamo_bien LEFT JOIN bienes_publicos B ON 
                                    T.id_bien=B.id_bien LEFT JOIN usuario U ON B.responsable=U.id 
                                    LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D 
                                    ON P.departamento_id=D.departamento_id 
                                    WHERE id_tramite_bien = ".$router->getParam()))->fetch_assoc();
            if(!$prestamo)
                header("Location: ../404");
            if($prestamo["fecha_fin_tramite"] != null)
                header("Location: ../404");
            return include("frontend/bienes_publicos/bien_prestado.php");
        }
    }

    public function bienesFaltantes($router){
        if(empty($router->getParam())){
            include("backend/bd.php");
            $reportes = $bd->query("SELECT * FROM reporte_bien R 
                                    LEFT JOIN bienes_publicos B ON R.id_bien = B.id_bien
                                    LEFT JOIN usuario U ON B.responsable=U.id 
                                    LEFT JOIN perfil P ON U.id=P.id_usuario");
            include("frontend/bienes_publicos/reportes_bienes.php");
        } else {
            include("backend/bd.php");

            $bien = ($bd->query("SELECT * FROM reporte_bien R 
            LEFT JOIN bienes_publicos B ON R.id_bien = B.id_bien
            LEFT JOIN usuario U ON B.responsable=U.id 
            LEFT JOIN perfil P ON U.id=P.id_usuario 
            INNER JOIN departamento D ON P.departamento_id =D.departamento_id
            INNER JOIN cargo C ON P.cargo_id=C.cargo_id
            WHERE id_reporte_bien = ".$router->getParam()))->fetch_assoc();

            if(!$bien)
                header("Location: ../404");
            $analista = ($bd->query("SELECT * FROM usuario U LEFT JOIN perfil P ON 
                    U.id=P.id_usuario INNER JOIN cargo C ON P.cargo_id=C.cargo_id WHERE id = ".$bien["incorporado_por"]))->fetch_assoc();
            include("frontend/bienes_publicos/bien_faltante.php");
        }
    }

    public function desincorporarBien($router){
        if(empty($router->getParam())){
            include("backend/bd.php");
            $reportes = $bd->query("SELECT * FROM reporte_bien R 
                                    LEFT JOIN bienes_publicos B ON R.id_bien = B.id_bien
                                    LEFT JOIN usuario U ON B.responsable=U.id 
                                    LEFT JOIN perfil P ON U.id=P.id_usuario WHERE reporte_tramitado = true
                                    AND desincorporado = false");
            include("frontend/bienes_publicos/desincorporacion_bienes.php");
        } else {
            include("backend/bd.php");

            $bien = ($bd->query("SELECT * FROM reporte_bien R 
            LEFT JOIN bienes_publicos B ON R.id_bien = B.id_bien
            LEFT JOIN usuario U ON B.responsable=U.id 
            LEFT JOIN perfil P ON U.id=P.id_usuario 
            INNER JOIN departamento D ON P.departamento_id =D.departamento_id
            INNER JOIN cargo C ON P.cargo_id=C.cargo_id
            WHERE id_reporte_bien = ".$router->getParam()))->fetch_assoc();

            if(!$bien)
                header("Location: ../404");
            
            include("frontend/bienes_publicos/desincorporar_bien.php");
        }
    }

    public function programarInventario($router){
        include("backend/bd.php");
        $ultimo = ($bd->query("SELECT * FROM inventario ORDER BY id_inventario DESC LIMIT 1")->fetch_assoc());
        include("frontend/bienes_publicos/programar_inventario.php");
    }

    public function aprobarInventario($router){
        include("backend/bd.php");
        $ultimo = ($bd->query("SELECT * FROM inventario ORDER BY id_inventario DESC LIMIT 1")->fetch_assoc());
        include("frontend/bienes_publicos/aprobar_inventario.php");
    }

    public function levantarInventario($router){
        include("backend/bd.php");
        $ultimo = ($bd->query("SELECT * FROM inventario ORDER BY id_inventario DESC LIMIT 1")->fetch_assoc());
        if($ultimo["aprobado"] && $ultimo["fecha_fin_inventario"] ==null){
            $inventario = $bd->query("SELECT * FROM bienes_publicos B LEFT JOIN usuario U ON
                        B.responsable=U.id LEFT JOIN perfil P ON U.id=P.id_usuario
                        LEFT JOIN departamento D ON P.departamento_id = D.departamento_id 
                        WHERE existente =true AND D.departamento_id = ".$_SESSION["departamento_id"]);
            $inventario2 = $bd->query("SELECT * FROM bienes_publicos B LEFT JOIN usuario U ON
                B.responsable=U.id LEFT JOIN perfil P ON U.id=P.id_usuario
                LEFT JOIN departamento D ON P.departamento_id = D.departamento_id 
                WHERE existente =true AND D.departamento_id = ".$_SESSION["departamento_id"]);
        }
        
        include("frontend/bienes_publicos/levantar_inventario.php");
    }

    public function dataInventario($router){
        include("backend/bd.php");
        if(!empty($router->getParam())){
            $id_data = $router->getParam();
            $inventario = ($bd->query("SELECT * FROM inventario_departamento I LEFT JOIN departamento D
                ON I.departamento_id = D.departamento_id LEFT JOIN usuario U ON
                I.gerente=U.id LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN inventario IV
                ON I.id_inventario=IV.id_inventario WHERE id_inventario_departamento = $id_data"))->fetch_assoc();
            if(!$inventario)
                header("Location: ../404"); 
            $data = $bd->query("SELECT * FROM inventario_data ID LEFT JOIN bienes_publicos B
                ON ID.id_bien = B.id_bien WHERE id_inventario_departamento = $id_data");

            include("frontend/bienes_publicos/inventario_data.php");
        } else{
            $ultimo = ($bd->query("SELECT * FROM inventario ORDER BY id_inventario DESC LIMIT 1")->fetch_assoc());
            if($ultimo["aprobado"] && $ultimo["fecha_fin_inventario"] ==null){
                $inventarios = $bd->query("SELECT * FROM inventario_departamento I LEFT JOIN departamento D
                    ON I.departamento_id = D.departamento_id WHERE id_inventario = ".$ultimo["id_inventario"]);
                
            }
            include("frontend/bienes_publicos/inventarios_data.php");
        }
    }

    public function dataInventarioPDF($router){
        if(!empty($router->getParam())){
            include("backend/bd.php");
            $id_data = $router->getParam();
            $inventario = ($bd->query("SELECT * FROM inventario_departamento I LEFT JOIN departamento D
                ON I.departamento_id = D.departamento_id LEFT JOIN usuario U ON
                I.gerente=U.id LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN inventario IV
                ON I.id_inventario=IV.id_inventario WHERE id_inventario_departamento = $id_data"))->fetch_assoc();
            if(!$inventario)
                header("Location: ../404"); 
            $data = $bd->query("SELECT * FROM inventario_data ID LEFT JOIN bienes_publicos B
                ON ID.id_bien = B.id_bien WHERE id_inventario_departamento = $id_data");

            include("frontend/bienes_publicos/inventario_data_pdf.php");
        } else{
            header("Location: 404");
        }
    }

    public function desincorporarBienes($router){
        include("backend/bd.php");
        if(!empty($router->getParam())){
            $bien = ($bd->query("SELECT * FROM bienes_publicos B LEFT JOIN usuario U ON
            B.responsable=U.id LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D ON
            B.departamento_id=D.departamento_id WHERE id_bien = ".$router->getParam()))->fetch_assoc();
            
            include("frontend/bienes_publicos/desincorporacion_bien_existente.php");
        } else{
            $bienes = $bd->query("SELECT * FROM bienes_publicos B LEFT JOIN usuario U ON
            B.responsable=U.id LEFT JOIN perfil P ON U.id=P.id_usuario LEFT JOIN departamento D ON
            B.departamento_id=D.departamento_id WHERE existente = true");
            
            include("frontend/bienes_publicos/desincorporar_bienes.php");
        }
    }
}