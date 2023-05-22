<?php
require_once 'C:\xampp\htdocs\validaciones_php\config\connection.php';

class PersonModel extends DBAbstractModel {

    public function __construct()
    {
        $this->connect();
    }
    protected $table = 'persona';
    public function validarUsuario($user, $password) {
        $query = "SELECT * FROM login WHERE user = '$user' AND password = '$password'";
        $result = $this->conn->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }
    public function getAllPersons() {
        $query = "SELECT * FROM $this->table";
        $result = $this->conn->query($query);

        $persons = array();
        while ($row = $result->fetch_assoc()) {
            $persons[] = $row;
        }

        return $persons;
    }

    public function addPerson($nombre, $edad, $sexo, $direccion) {
        $nombre = $this->conn->real_escape_string($nombre);
        $edad = $this->conn->real_escape_string($edad);
        $sexo = $this->conn->real_escape_string($sexo);
        $direccion = $this->conn->real_escape_string($direccion);

        $query = "INSERT INTO $this->table (nombre, edad, sexo, direccion) VALUES ('$nombre', '$edad', '$sexo', '$direccion')";
        $result = $this->conn->query($query);

        return $result;
    }

    public function getPersonById($id) {
        $query = "SELECT * FROM $this->table WHERE id = '$id'";
        $result = $this->conn->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function updatePerson($id, $nombre, $edad, $sexo, $direccion) {
        $nombre = $this->conn->real_escape_string($nombre);
        $edad = $this->conn->real_escape_string($edad);
        $sexo = $this->conn->real_escape_string($sexo);
        $direccion = $this->conn->real_escape_string($direccion);

        $query = "UPDATE $this->table SET nombre = '$nombre', edad = '$edad', sexo = '$sexo', direccion = '$direccion' WHERE id = '$id'";
        $result = $this->conn->query($query);

        return $result;
    }

    public function deletePerson($id) {
        $query = "DELETE FROM $this->table WHERE id = '$id'";
        $result = $this->conn->query($query);

        return $result;
    }

}


?>
