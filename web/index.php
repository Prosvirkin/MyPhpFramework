<?php

error_reporting(-1);

use vendor\core\Router;

$url = rtrim($_SERVER["QUERY_STRING"], '/');

define("WWW", __DIR__);
define("CORE", dirname(__DIR__) . 'vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'default');

require "../vendor/libs/functions.php";

spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . ".php";
    if (file_exists($file)) {
        require_once "$file";
    }
});

// Пользовательские контроллеры
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

// Дефолтные контроллеры
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');


Router::dispatch($url);