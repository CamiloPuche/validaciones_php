<?php
require_once 'C:\xampp\htdocs\validaciones_php\config\connection.php';

class SalaryModel extends DBAbstractModel
{

    public function __construct()
    {
        $this->connect();
    }

    public function getAllSalarios()
    {
        $query = "SELECT sn.*, p.nombre FROM salario_neto AS sn INNER JOIN persona AS p ON sn.id = p.id";
        $result = $this->conn->query($query);

        $salarios = array();
        while ($row = $result->fetch_assoc()) {
            $salarios[] = $row;
        }

        return $salarios;
    }

    public function getSalarioById($id)
    {
        $query = "SELECT * FROM salario_neto WHERE id = '$id'";
        $result = $this->conn->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function addSalario($id, $nhoras, $vhoras)
    {
        // Calcular los valores basados en las fórmulas proporcionadas
        $salario_basico = $nhoras * $vhoras;
        $subsidio = ($salario_basico < 2320000) ? $salario_basico * 0.1 : 0;

        if ($salario_basico <= 2320000) {
            $retencion = 0;
        } elseif ($salario_basico <= 4640000) {
            $retencion = $salario_basico * 0.07;
        } else {
            $retencion = $salario_basico * 0.13;
        }

        $seguro_social = $salario_basico * 0.04;
        $hextras = ($nhoras > 48) ? ($nhoras - 48) * ($vhoras * 2) : 0;
        $salario_neto = $salario_basico + $subsidio + $hextras - ($retencion + $seguro_social);

        $query = "INSERT INTO salario_neto (id, nhoras, vhoras, salario_basico, subsidio, retencion, seguro_social, hextras, salario_neto) VALUES ('$id', '$nhoras', '$vhoras', '$salario_basico','$subsidio', '$retencion', '$seguro_social', '$hextras', '$salario_neto')";
        $result = $this->conn->query($query);

        return $result;
    }

    public function updateSalario($id, $nhoras, $vhoras)
    {
        // Calcular los valores basados en las fórmulas proporcionadas
        $salario_basico = $nhoras * $vhoras;
        $subsidio = ($salario_basico < 2320000) ? $salario_basico * 0.1 : 0;

        if ($salario_basico <= 2320000) {
            $retencion = 0;
        } elseif ($salario_basico <= 4640000) {
            $retencion = $salario_basico * 0.07;
        } else {
            $retencion = $salario_basico * 0.13;
        }
        $seguro_social = $salario_basico * 0.04;
        $hextras = ($nhoras > 48) ? ($nhoras - 48) * ($vhoras * 2) : 0;
        $salario_neto = $salario_basico + $subsidio + $hextras - ($retencion + $seguro_social);

        $query = "UPDATE salario_neto
                SET nhoras = '$nhoras', vhoras = '$vhoras', salario_basico = '$salario_basico', subsidio = '$subsidio',
                retencion = '$retencion', seguro_social = '$seguro_social', hextras = '$hextras', salario_neto = '$salario_neto'
                WHERE id = '$id'";

        $result = $this->conn->query($query);

        return $result;
    }

    public function deleteSalario($id)
    {
        $query = "DELETE FROM salario_neto WHERE id = '$id'";
        $result = $this->conn->query($query);

        return $result;
    }

    public function validarUsuario($user, $password)
    {
    }
}