<?php
require_once 'C:\xampp\htdocs\validaciones_php\Model\salaryModel.php';

class SalaryController {
    private $model;
    public function __construct() {
        $this->model = new SalaryModel();
    }

    public function getAllSalarios() {
        return $this->model->getAllSalarios();
    }

    public function getSalarioById($id) {
        return $this->model->getSalarioById($id);
    }

    public function addSalario($id, $nhoras, $vhoras) {
        $this->model->addSalario($id, $nhoras, $vhoras);
    }

    public function updateSalario($id, $nhoras, $vhoras) {
        $this->model->updateSalario($id, $nhoras, $vhoras);
    }

    public function deleteSalario($id) {
        $this->model->deleteSalario($id);
    }
}
