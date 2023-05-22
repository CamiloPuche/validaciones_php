<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'Administrador') {
    header('Location: View\login\login.php');
}

require_once 'C:\xampp\htdocs\validaciones_php\Controller\salaryController.php';

$salaryController = new SalaryController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_salary'])) {
        $id = $_POST['id'];
        $nhoras = $_POST['nhoras'];
        $vhoras = $_POST['vhoras'];

        $salaryController->addSalario($id, $nhoras, $vhoras);
    } elseif (isset($_POST['update_salary'])) {
        $id = $_POST['id'];
        $nhoras = $_POST['nhoras'];
        $vhoras = $_POST['vhoras'];

        $salaryController->updateSalario($id, $nhoras, $vhoras);
    } elseif (isset($_POST['delete_salary'])) {
        $id = $_POST['id'];

        $salaryController->deleteSalario($id);
    }
}

$salarios = $salaryController->getAllSalarios();
?>
<!-- HTML y código para mostrar la tabla de salarios y opciones para agregar, editar y eliminar -->
<h1>Administración de Salarios</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Número de Horas</th>
            <th>Valor de Horas</th>
            <th>Salario Básico</th>
            <th>Subsidio</th>
            <th>Retención</th>
            <th>Seguro Social</th>
            <th>Horas Extras</th>
            <th>Salario Neto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($salarios as $salario): ?>
            <tr>
                <td>
                    <?php echo $salario['id']; ?>
                </td>
                <td>
                    <?php echo $salario['nombre']; ?>
                </td>
                <td>
                    <?php echo $salario['nhoras']; ?>
                </td>
                <td>
                    <?php echo $salario['vhoras']; ?>
                </td>
                <td>
                    <?php echo $salario['salario_basico']; ?>
                </td>
                <td>
                    <?php echo $salario['subsidio']; ?>
                </td>
                <td>
                    <?php echo $salario['retencion']; ?>
                </td>
                <td>
                    <?php echo $salario['seguro_social']; ?>
                </td>
                <td>
                    <?php echo $salario['hextras']; ?>
                </td>
                <td>
                    <?php echo $salario['salario_neto']; ?>
                </td>
                <td>
                    <a href="index.php?controller=salario&action=edit_salary&id=<?php echo $salario['id']; ?>">Editar</a>
                    <a href="#" onclick="confirmDelete(<?php echo $salario['id']; ?>)">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?controller=salario&action=add_salary">Agregar Salario</a>

<a href="?controller=administrador" style="text-decoration: none;">
    <button style="padding: 10px 20px;">Volver</button>
</a>

<script>
    function confirmDelete(id) {
        var result = confirm("¿Estás seguro de que deseas eliminar esta persona?");
        if (result) {
            window.location.href = "?controller=salario&action=delete_salary&id=" + id;
        }
    }
</script>