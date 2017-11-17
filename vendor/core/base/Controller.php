<?php

namespace vendor\core\base;


abstract class Controller
{
    // Текущий путь
    public $route = [];
    // Текущий вид
    public $view;
    // Текущий шаблон
    public $layout;
    // Пользовательские данные
    public $data = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route["action"];
    }

    public function getView()
    {
        $viewObj = new View($this->route, $this->layout, $this->view);
        $viewObj->render($this->data);
    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function isAjax()
    {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest";
    }

    public function loadView($view, $data){
        extract($data);
        require APP."/views/{$this->route['controller']}/{$view}.php";
    }

}