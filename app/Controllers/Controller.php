<?php

namespace Deviter\Application\Controllers;

use Xodity\Deviter\Xodim\Flasher;
/**
 * BaseController
 * 
 * This is base class for all controllers
 */
class Controller
{
    public $flasher;

    public function __construct()
    {
        $this->flasher = new Flasher;
    }

    public function view($viewName, $data = [])
    {
        if (strpos($viewName, ".")) {
            $viewName = str_replace(".", DIRECTORY_SEPARATOR, $viewName);
        }
        $flasher = $this->flasher;

        $viewPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'rune' . DIRECTORY_SEPARATOR . $viewName . '.' . 'rune.php';
        require_once $viewPath;
    }

    public function redirect($route)
    {
        header("Location: " . $route);
        return $this->flasher;
    }

    public function hash($value)
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

    public function hash_check($value, $hash)
    {
        return password_verify($value, $hash);
    }

    
}

function view($viewName, $data = []) {
    $controller = new Controller();
    return $controller->view($viewName, $data);
}

function redirect($route) {
    $controller = new Controller();
    return $controller->redirect($route);
}