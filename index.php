<?php
session_start();
require "config.php";
class Router
{
    private $_ctrl;

    public function routeReq()
    {
        try {
            // Autoload des classes
            spl_autoload_register(function ($class) {
                require_once("models/" . $class . ".php");
            });

            $url = "";

            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controller = str_replace(' ', '', ucwords(str_replace('-', ' ', strtolower($url[0]))));
                $controllerClass = $controller . "Controller";
                $controllerFile = "controllers/" . $controllerClass . ".php";

                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                } else {
                    throw new Exception('404 Page Not Found');
                }
            } else {
                require_once("controllers/AccueilController.php");
                $this->_ctrl = new AccueilController([]);
            }
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            require_once('views/error.php');
        }
    }
}


$router = new Router;
$router->routeReq();