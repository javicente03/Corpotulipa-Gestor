<?php

class ControllersRecursos
{
    public function crearInduccion($router)
    {
        include("backend/bd.php");
        $usuarios = $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON U.id=P.id_usuario");
        $array = array();

        while ($usuario = $usuarios->fetch_assoc()) {
            $existe = ($bd->query("SELECT * FROM induccion WHERE id_usuario = " . $usuario["id"]))->fetch_assoc();
            if (!$existe)
                array_push($array, $usuario);
        }

        $responsables = $bd->query("SELECT * FROM  usuario U INNER JOIN perfil P ON U.id=P.id_usuario
                        ORDER BY p.apellido ASC");

        include("frontend/recursos_humanos/crear_induccion.php");
    }

    public function asistirInduccion($router)
    {
        if(!empty($router->getParam())){
            include("backend/bd.php");
            $induccion = ($bd->query("SELECT * FROM induccion 
                        WHERE id_induccion = ".$router->getParam()))->fetch_assoc();
            if($induccion["id_usuario"] == $_SESSION["id"]){
                include("frontend/recursos_humanos/induccion.php");
            } else
                header("Location: ../404");
        } else
            header("Location: 404");
    }

    public function solicitarPermiso($router){
        if(empty($router->getParam())){
            include("backend/bd.php");
            $responsables = $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON
                            U.id=P.id_usuario LEFT JOIN cargo C ON P.cargo_id=C.cargo_id
                            WHERE C.rango = 1 AND P.departamento_id = ".$_SESSION["departamento_id"]);
            include("frontend/recursos_humanos/solicitar_permiso.php");
        } else {
            include("backend/bd.php");
            $permiso = ($bd->query("SELECT * FROM solicitud_permiso S LEFT JOIN usuario U 
                        ON S.id_usuario=U.id INNER JOIN perfil P ON
                        U.id=P.id_usuario WHERE id_solicitud_permiso = ".$router->getParam()))->fetch_assoc();
            if(!$permiso)
                header("Location: ../404");
            if($permiso["responsable"] != $_SESSION["id"])
                header("Location: ../404");
            include("frontend/recursos_humanos/aprobar_permiso.php");    
        }
    }
}
