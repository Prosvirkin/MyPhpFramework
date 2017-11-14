<?php

namespace vendor\core;

class Router
{
    protected static $route = []; // Текущий Маршрут
    protected static $routes = []; // Таблица маршрутов

    // Добавление маршрута в таблицу маршрутов
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    // Получение таблицы маршрутов (Для себя)
    public static function getRoutes()
    {
        return self::$routes;
    }

    // Получение текущего маршрута
    public static function getRoute()
    {
        return self::$route;
    }

    // Проверка на существование маршрута в таблице маршрутов
    // и присвоение к $route
    private static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    // Редирект на нужный контроллер
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'];
            if (class_exists($controller)) {
                $controllerObj = new $controller(self::$route);
                $action = self::lowerCase(self::$route['action']) . "Action";
                if (method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                    $controllerObj->getView();
                } else {
                    echo "Method not found";
                }
            } else {
                echo "Controller $controller not found";
            }
        } else {
            http_response_code(404);
            include '404.php';
        }
    }

    // Преобразование url (example-example) к имени контроллера ExampleExample
    protected static function upperCase($name)
    {
        $name = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
        return $name;
    }

    // Преобразование url (example-example) к имени экшена exampleExample
    protected static function lowerCase($name)
    {
        return lcfirst(self::upperCase($name));
    }

    // Обрезание явных гет параметров в url
    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode("&", $url, 2);
            if (false === strpos($params['0'], '=')) {
                return rtrim($params['0'], '/');
            } else {
                return '';
            }
        }
    }
}