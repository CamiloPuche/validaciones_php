<?php
require_once 'config\connection.php';
class LoginModel
{

    private $database;

    public function __construct()
    {
        $this->database = connection::conectar();
    }

    public function validarUsuario($user, $password)
    {
        $statement = $this->database->prepare("SELECT * FROM login WHERE user=:user AND password=:password");
        $statement->bindParam(":user", $user);
        $statement->bindParam(":password", $password);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}