<?php
session_start(); // Nécessaire pour gérer les sessions
require "../config.php";

require_once("models/Auth.php");

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

            // Contrôleurs qui NE nécessitent PAS de connexion
            $unprotectedControllers = ['Login', 'Logout'];

            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controller = str_replace(' ', '', ucwords(str_replace('-', ' ', strtolower($url[0]))));
                $controllerClass = $controller . "Controller";
                $controllerFile = "controllers/" . $controllerClass . ".php";

                // Vérification de connexion sauf si le contrôleur est dans $unprotectedControllers
                if (!in_array($controller, $unprotectedControllers) && !Auth::isLoggedIn()) {
                    header("Location: ./login");
                    exit;
                }

                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                } else {
                    throw new Exception('404 Page Not Found');
                }
            } else {
                header("Location: ./accueil");
                exit;
            }
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            require_once('views/error.php');
        }
    }
}

$router = new Router;
$router->routeReq();
