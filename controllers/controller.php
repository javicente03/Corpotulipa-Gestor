<?php

class ControllersSuperuser{

    // Crear Usuario y enlistar
    public function generarUser($router){
        include('backend/bd.php');
        $sql="SELECT * FROM departamento";
        $proceso=$bd->query($sql);
        $sql1="SELECT * FROM cargo";
        $proceso1=$bd->query($sql1);
        $sql2="SELECT * FROM usuario INNER JOIN perfil ON usuario.id = perfil.id_usuario LEFT JOIN cargo ON perfil.cargo_id = cargo.cargo_id LEFT JOIN departamento ON perfil.departamento_id = departamento.departamento_id";
        $proceso2=$bd->query($sql2);
        return include("frontend/superuser/crear_usuario.php");
    }

    // Editar usuario
    public function editarUser($router){
        include('backend/bd.php');
        $sql = "SELECT * FROM usuario INNER JOIN perfil ON usuario.id = perfil.id_usuario LEFT JOIN cargo ON perfil.cargo_id = cargo.cargo_id LEFT JOIN departamento ON perfil.departamento_id = departamento.departamento_id WHERE id_usuario = ".$router->getParam();
        $proceso=$bd->query($sql);
        if($usuario = $proceso->fetch_assoc()){
            echo $usuario['nombre'];
            echo $usuario['apellido'];
            echo $usuario['email'];
        } else
            return header("Location: ../404");
        $sql2="SELECT * FROM departamento";
        $proceso2=$bd->query($sql2);
        $sql1="SELECT * FROM cargo";
        $proceso1=$bd->query($sql1);
        return include("frontend/superuser/editar_usuario.php");
    }

    // Crear Departamentos y enlistar
    public function departamentos($router){
        include('backend/bd.php');
        $sql="SELECT * FROM departamento";
        $proceso=$bd->query($sql);
        return include("frontend/superuser/crear_departamento.php");
    }

    // Editar Departamentos
    public function editarDepartamento($router){
        include('backend/bd.php');
        $sql="SELECT * FROM departamento WHERE departamento_id=".$router->getParam();
        $proceso=$bd->query($sql);
        if ($data = $proceso->fetch_assoc()) {
            $siglas = $data['siglas'];
            $nombre = $data['departamento'];
        } else {
            return header("Location: ../404");
        }
        return include("frontend/superuser/editar_departamento.php");
    }

    // Crear Cargos y enlistar
    public function cargos($router){
        include('backend/bd.php');
        $sql="SELECT * FROM cargo";
        $proceso=$bd->query($sql);
        return include("frontend/superuser/crear_cargos.php");
    }

    // Editar Cargos
    public function editarCargo($router){
        include('backend/bd.php');
        $sql="SELECT * FROM cargo WHERE cargo_id=".$router->getParam();
        $proceso=$bd->query($sql);
        if ($data = $proceso->fetch_assoc()) {
            $rango = $data['rango'];
            $nombre = $data['cargo'];
        } else {
            return header("Location: ../404");
        }
        return include("frontend/superuser/editar_cargos.php");
    }

    // Crear Permisos y enlistar
    public function permisos($router){
        include('backend/bd.php');
        $sql="SELECT * FROM permisos INNER JOIN cargo ON permisos.cargo_id = cargo.cargo_id";
        $proceso=$bd->query($sql);
        $sql1="SELECT * FROM cargo";
        $proceso1=$bd->query($sql1);
        return include("frontend/superuser/crear_permiso.php");
    }

}