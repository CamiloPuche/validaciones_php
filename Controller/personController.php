<?php
require_once 'C:\xampp\htdocs\validaciones_php\Model\personModel.php';

class PersonController
{
    private $personModel;

    public function __construct()
    {
        $this->personModel = new PersonModel();
    }

    public function getAllPersons()
    {
        return $this->personModel->getAllPersons();
    }

    public function getPersonById($id)
    {
        return $this->personModel->getPersonById($id);
    }

    public function addPerson($nombre, $edad, $sexo, $direccion)
    {
        return $this->personModel->addPerson($nombre, $edad, $sexo, $direccion);
    }

    public function updatePerson($id, $nombre, $edad, $sexo, $direccion)
    {
        return $this->personModel->updatePerson($id, $nombre, $edad, $sexo, $direccion);
    }

    public function deletePerson($id)
    {
        return $this->personModel->deletePerson($id);
    }
}
?>