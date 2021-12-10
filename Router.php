<?php

class Router{
    public $uri;
    public $controller;
    public $param;

    public function __construct(){
        $this->setUri();
        $this->setController();
        $this->setParam();
    }

    public function setUri(){
        $this->uri = explode('/', $_SERVER['REQUEST_URI']);
    }

    public function setController(){
        $this->controller = $this->uri[2] === '' ? 'Home' : $this->uri[2];
    }

    public function setParam(){
        $this->param = !empty($this->uri[3]) ? $this->uri[3] : '';
    }

    public function getUri(){
        return $this->uri;
    }

    public function getController(){
        return $this->controller;
    }

    public function getParam(){
        return $this->param;
    }
}