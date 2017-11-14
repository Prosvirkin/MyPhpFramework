<?php

namespace vendor\core\base;


class View
{
    // Текущий маршрут и параметры Controller, Action
    public $rout;
    // Текущий вид
    public $view;
    // Текущий шаблон
    public $layout;

    public function __construct($rout, $layout = "", $view = "")
    {
        $this->rout = $rout;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    public function render($data)
    {
        if(is_array($data)) extract($data);
        $file_view = APP . "/views/{$this->rout["controller"]}/{$this->view}.php";
        ob_start();
        if (is_file($file_view)) {
            require $file_view;
        } else {
            echo "<p> Вид не найден $file_view</p>";
        }
        $content = ob_get_clean();

        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($file_layout)) {
                require $file_layout;
            } else {
                echo "<p> Шаблон не найден $file_layout</p>";
            }
        }


    }
}