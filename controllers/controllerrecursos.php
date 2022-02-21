<?php

class ControllersRecursos
{
    public function crearInduccion($router)
    {
        include("backend/bd.php");
        $usuarios = $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON U.id=P.id_usuario 
                                LEFT JOIN cargo C ON P.cargo_id=C.cargo_id");
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
        if (!empty($router->getParam())) {
            include("backend/bd.php");
            $induccion = ($bd->query("SELECT * FROM induccion 
                        WHERE id_induccion = " . $router->getParam()))->fetch_assoc();
            if ($induccion["id_usuario"] == $_SESSION["id"]) {
                include("frontend/recursos_humanos/induccion.php");
            } else
                header("Location: ../404");
        } else
            header("Location: 404");
    }

    public function solicitarPermiso($router)
    {
        if (empty($router->getParam())) {
            include("backend/bd.php");
            $responsables = $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON
                            U.id=P.id_usuario LEFT JOIN cargo C ON P.cargo_id=C.cargo_id
                            WHERE C.rango = 1 AND P.departamento_id = " . $_SESSION["departamento_id"]);
            include("frontend/recursos_humanos/solicitar_permiso.php");
        } else {
            include("backend/bd.php");
            $permiso = ($bd->query("SELECT * FROM solicitud_permiso S LEFT JOIN usuario U 
                        ON S.id_usuario=U.id INNER JOIN perfil P ON
                        U.id=P.id_usuario WHERE id_solicitud_permiso = " . $router->getParam()))->fetch_assoc();
            if (!$permiso)
                header("Location: ../404");
            if ($permiso["responsable"] != $_SESSION["id"])
                header("Location: ../404");
            include("frontend/recursos_humanos/aprobar_permiso.php");
        }
    }

    public function solicitudAdiestramiento($router)
    {
        include("backend/bd.php");
        $sql = "SELECT * FROM permisos WHERE accion = 'Solicitud_Adiestramiento' AND cargo_id =" . $_SESSION['cargo_id'];
        $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
        if ($query->num_rows > 0) {
            $participantes = $bd->query("SELECT * FROM usuario U INNER JOIN perfil P ON
                                    U.id=P.id_usuario LEFT JOIN cargo C ON P.cargo_id=C.cargo_id
                                    WHERE P.departamento_id = " . $_SESSION["departamento_id"]);
            include("frontend/recursos_humanos/solicitar_adiestramiento.php");
        } else
            header("Location: 404");
    }

    public function solicitudesAdiestramiento($router)
    {
        include("backend/bd.php");

        if (empty($router->getParam())) {
            $solicitudes = $bd->query("SELECT * FROM adiestramiento A LEFT JOIN 
                usuario U ON A.solicitante=U.id INNER JOIN perfil P ON U.id=P.id_usuario 
                LEFT JOIN departamento D ON P.departamento_id=D.departamento_id 
                WHERE fecha_adiestramiento IS NULL");
            include("frontend/recursos_humanos/solicitudes_adiestramiento.php");
        } else {
            $solicitud = ($bd->query("SELECT * FROM adiestramiento A LEFT JOIN 
                usuario U ON A.solicitante=U.id INNER JOIN perfil P ON U.id=P.id_usuario 
                LEFT JOIN departamento D ON P.departamento_id=D.departamento_id 
                WHERE id_adiestramiento = " . $router->getParam()))->fetch_assoc();

            if (!$solicitud)
                header("Location: ../404");
            if ($solicitud["fecha_adiestramiento"] != null)
                header("Location: ../404");
            $participantes = $bd->query("SELECT * FROM participante_adiestramiento PA
                                    LEFT JOIN usuario U ON PA.participante=U.id 
                                    INNER JOIN perfil P ON U.id=P.id_usuario 
                                    LEFT JOIN cargo C ON P.cargo_id=C.cargo_id 
                                    WHERE id_adiestramiento = " . $solicitud["id_adiestramiento"]);
            include("frontend/recursos_humanos/pautar_adiestramiento.php");
        }
    }

    public function aprobarAdiestramiento($router)
    {
        include("backend/bd.php");
        $sql = "SELECT * FROM permisos WHERE accion = 'Aprobar_Adiestramiento' AND cargo_id =" . $_SESSION['cargo_id'];
        $query = $bd->query($sql); //Revisa si tiene los permisos correspondientes en la tabla permisos
        if ($query->num_rows > 0) {
            if (empty($router->getParam())) {
                $solicitudes = $bd->query("SELECT * FROM adiestramiento A LEFT JOIN 
                usuario U ON A.solicitante=U.id INNER JOIN perfil P ON U.id=P.id_usuario 
                LEFT JOIN departamento D ON P.departamento_id=D.departamento_id 
                WHERE fecha_adiestramiento IS NOT NULL AND aprobado=false");
                include("frontend/recursos_humanos/adiestramientos_por_aprobar.php");
            } else {
                $solicitud = ($bd->query("SELECT * FROM adiestramiento A LEFT JOIN 
                usuario U ON A.solicitante=U.id INNER JOIN perfil P ON U.id=P.id_usuario 
                LEFT JOIN departamento D ON P.departamento_id=D.departamento_id WHERE
                fecha_adiestramiento IS NOT NULL AND aprobado=false AND id_adiestramiento = " . $router->getParam()))->fetch_assoc();

                if (!$solicitud)
                    header("Location: ../404");
                $participantes = $bd->query("SELECT * FROM participante_adiestramiento PA
                                    LEFT JOIN usuario U ON PA.participante=U.id 
                                    INNER JOIN perfil P ON U.id=P.id_usuario 
                                    LEFT JOIN cargo C ON P.cargo_id=C.cargo_id 
                                    WHERE id_adiestramiento = " . $solicitud["id_adiestramiento"]);
                include("frontend/recursos_humanos/aprobar_adiestramiento.php");
            }
        } else
            header("Location: 404");
    }

    public function verAdiestramiento($router)
    {
        if (!empty($router->getParam())) {
            include("backend/bd.php");

            $participante = ($bd->query("SELECT * FROM participante_adiestramiento PA
                                    LEFT JOIN adiestramiento A ON PA.id_adiestramiento=A.id_adiestramiento
                                    WHERE pregunta1='none'AND participante = " . $_SESSION["id"] . " AND PA.id_adiestramiento = " . $router->getParam()))->fetch_assoc();


            if (!$participante)
                header("Location: ../404");
            else
                include("frontend/recursos_humanos/ver_adiestramiento.php");
        } else
            header("Location: 404");
    }

    public function verFuncionarios($router)
    {
        include("backend/bd.php");
        if (!empty($router->getParam())) {

            $funcionario = ($bd->query("SELECT * FROM usuario U LEFT JOIN perfil P ON
                U.id = P.id_usuario LEFT JOIN cargo C ON P.cargo_id = C.cargo_id LEFT JOIN departamento D
                ON P.departamento_id = D.departamento_id WHERE id = ".$router->getParam()))->fetch_assoc();
            
            if (!$funcionario)
                header("Location: ../404");

            $permisos = $bd->query("SELECT * FROM solicitud_permiso S LEFT JOIN usuario U ON
                S.id_usuario = U.id INNER JOIN perfil P ON U.id=P.id_usuario 
                WHERE S.id_usuario = ".$router->getParam()." ORDER BY id_solicitud_permiso DESC");

            
            include("frontend/recursos_humanos/ver_funcionario.php");
        } else{
            $funcionarios = $bd->query("SELECT * FROM usuario U LEFT JOIN perfil P ON
                U.id = P.id_usuario LEFT JOIN cargo C ON P.cargo_id = C.cargo_id 
                WHERE P.departamento_id = ".$_SESSION["departamento_id"]);
            include("frontend/recursos_humanos/lista_funcionarios.php");
        }
    }
}
