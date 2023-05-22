<?php
require_once 'C:\xampp\htdocs\validaciones_php\config\connection.php';

class LoginModel extends DBAbstractModel {

    public function __construct(){
        $this->connect();
    }
    protected $table = 'login';
    public function validarUsuario($user, $password) {
        $query = "SELECT * FROM $this->table WHERE user = '$user' AND password = '$password'";
        $result = $this->conn->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }
}
?>
