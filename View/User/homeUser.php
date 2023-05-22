<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'Usuario') {
    header('Location: View\login\login.php');
}

require_once 'C:\xampp\htdocs\validaciones_php\Controller\personController.php';
require_once 'Controller\salaryController.php';

$personController = new PersonController();
$persons = $personController->getAllPersons();
$salaryController = new SalaryController();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vista de Usuario</title>
</head>
<body>
    <h2>Vista de Usuario</h2>

    <h3>Lista de Personas</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>Dirección</th>
            <th>Salario Neto</th>
        </tr>
        <?php foreach ($persons as $person){ ?>
            <tr>
                <td><?php echo $person['id']; ?></td>
                <td><?php echo $person['nombre']; ?></td>
                <td><?php echo $person['edad']; ?></td>
                <td><?php echo $person['sexo']; ?></td>
                <td><?php echo $person['direccion']; ?></td>
                <td>
                <?php
                $salario = $salaryController->getSalarioById($person['id']);
                if ($salario !== null) {
                    echo $salario['salario_neto'];
                } else {
                    echo 'N/A';
                }
                ?>
            </td>
            </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
