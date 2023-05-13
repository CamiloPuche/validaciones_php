<?php
require_once 'C:\xampp\htdocs\validaciones_php\Model\loginModel.php';
class LoginController
{
    public function index()
    {
        require_once 'C:\xampp\htdocs\validaciones_php\View\login\login.php';
    }

    public function validar()
    {
        $user = $_POST['user'];
        $password = $_POST['password'];
        $model = new LoginModel();
        $resultado = $model->validarUsuario($user, $password);

        if ($resultado) {
            session_start();
            $_SESSION['user'] = $resultado;

            if ($resultado['rol'] == 'Administrador') {
                header('Location: index.php?controller=administrador');
            } else {
                header('Location: index.php?controller=usuario');
            }
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    }

    public function administrador()
    {
        session_start();

        if (isset($_SESSION['user']) && $_SESSION['user']['rol'] == 'Administrador') {
            require_once 'C:\xampp\htdocs\validaciones_php\View\Admin\home.php';
        } else {
            header('Location: index.php');
        }
    }

    public function usuario()
    {
        session_start();

        if (isset($_SESSION['usuario'])) {
            require_once 'C:\xampp\htdocs\validaciones_php\View\User\homeUser.php';
        } else {
            header('Location: index.php');
        }
    }
}