<?php

class ControllersUser{
    public function login($router){
        return include("frontend/login.php");
    }

    public function olvidoPassword($router){
        return include("frontend/olvido_password.php");
    }

    public function resetearPassword($router){
        return include("frontend/resetear_password.php");
    }

    public function editarPerfil($router){
        return include("frontend/editar_perfil.php");
    }
}