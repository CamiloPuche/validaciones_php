<?php

require_once 'Controller/loginController.php';
require_once 'Controller/personController.php';

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
        case 'persona':
            $personController = new PersonController();

            if (!isset($_GET['action'])) {
                // Mostrar la lista de personas
                $persons = $personController->getAllPersons();
                // Aquí va el código para mostrar la vista de administración de personas (person_view.php)
                require_once 'View\Admin\person_view.php';
            } else {
                switch ($_GET['action']) {
                    case 'add_person':
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $nombre = $_POST['nombre'];
                            $edad = $_POST['edad'];
                            $sexo = $_POST['sexo'];
                            $direccion = $_POST['direccion'];
                            $personController->addPerson($nombre, $edad, $sexo, $direccion);
                            header('Location: index.php?controller=persona');
                        }
                        break;
                    case 'edit_person':
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $person = $personController->getPersonById($id);
                            // Aquí va el código para mostrar la vista de edición de persona
                            require_once 'View\Admin\edit_person_view.php';
                        }
                        break;
                    case 'update_person':
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $id = $_POST['id'];
                            $nombre = $_POST['nombre'];
                            $edad = $_POST['edad'];
                            $sexo = $_POST['sexo'];
                            $direccion = $_POST['direccion'];
                            $personController->updatePerson($id, $nombre, $edad, $sexo, $direccion);
                            header('Location: index.php?controller=persona');
                        }
                        break;
                    case 'delete_person':
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $personController->deletePerson($id);
                            header('Location: index.php?controller=persona');
                        }
                        break;
                    default:
                        // Mostrar la lista de personas por defecto
                        $persons = $personController->getAllPersons();
                        // Aquí va el código para mostrar la vista de administración de personas (admin_person_view.php)
                        header('Location: index.php?controller=persona');
                        break;
                }
            }
            break;
        case 'salario':
            require_once('Controller\salaryController.php');
            $salarioController = new SalaryController();

            if (!isset($_GET['action'])) {
                $salarios = $salarioController->getAllSalarios();
                require_once 'View\Admin\salary_view.php';
            } else {
                switch ($_GET['action']) {
                    case 'add_salary':
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $id = $_POST['id'];
                            $nhoras = $_POST['nhoras'];
                            $vhoras = $_POST['vhoras'];

                            $salarioController->addSalario($id, $nhoras, $vhoras);
                            header('Location: index.php?controller=salario');
                        } else {
                            $personController = new PersonController();
                            $persons = $personController->getAllPersons();
                            require_once 'View/Admin/add_salary.php';
                        }
                        break;
                    case 'edit_salary':
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $id = $_POST['id'];
                            $nhoras = $_POST['nhoras'];
                            $vhoras = $_POST['vhoras'];

                            $salarioController->updateSalario($id, $nhoras, $vhoras);
                            header('Location: index.php?controller=salario');
                            exit;
                        } else {
                            $id = $_GET['id'];
                            $salario = $salarioController->getSalarioById($id);
                            $personController = new PersonController();
                            $persons = $personController->getAllPersons();

                            if ($salario) {
                                $persons = $personController->getAllPersons();
                                require_once 'View\Admin\edit_salary_view.php';
                            } else {
                                header('Location: index.php?controller=salario');
                                exit;
                            }
                        }
                        break;
                    case 'delete_salary':
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $salarioController->deleteSalario($id);
                            header('Location: index.php?controller=salario');
                        }
                        break;
                    default:
                        $salarios = $salarioController->getAllSalarios();
                        require_once 'admin_salario_view.php';
                        break;
                }
            }
            break;
        default:
            $controller->index();
            break;
    }
}