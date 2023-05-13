<?php

require_once 'Controller/loginController.php';

$controller = new LoginController();

if (!isset($_GET['controller'])) {
    $controller->index();
} else {
    switch ($_GET['controller']) {
        case 'login':
            if (!isset($_GET['action'])) {
                $controller->index();
            } else {
                switch ($_GET['action']) {
                    case 'validar':
                        $controller->validar();
                        break;
                    default:
                        $controller->index();
                        break;
                }
            }
            break;
        case 'administrador':
            $controller->administrador();
            break;
        case 'usuario':
            $controller->usuario();
            break;
        default:
            $controller->index();
            break;
    }
}