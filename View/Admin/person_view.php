<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'Administrador') {
    header('Location: View\login\login.php');
}

require_once 'Controller\personController.php';
require_once 'Controller\salaryController.php';

$personController = new PersonController();
$salaryController = new SalaryController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_person'])) {
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];
        $direccion = $_POST['direccion'];

        $personController->addPerson($nombre, $edad, $sexo, $direccion);
    } elseif (isset($_POST['update_person'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];
        $direccion = $_POST['direccion'];

        $personController->updatePerson($id, $nombre, $edad, $sexo, $direccion);
    } elseif (isset($_POST['delete_person'])) {
        $id = $_POST['id'];

        $personController->deletePerson($id);
    }
}

$persons = $personController->getAllPersons();
?>

<h3>Agregar persona</h3>
<form method="POST" action="?controller=persona&amp;action=add_person">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad" required><br>

    <label for="sexo">Sexo:</label>
    <select id="sexo" name="sexo" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select><br><br>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" required><br>

    <button type="submit">Agregar</button>
</form>
<h3>Lista de personas</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Sexo</th>
        <th>Dirección</th>
        <th>Salario</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($persons as $person) { ?>
        <tr>
            <td>
                <?php echo $person['id']; ?>
            </td>
            <td>
                <?php echo $person['nombre']; ?>
            </td>
            <td>
                <?php echo $person['edad']; ?>
            </td>
            <td>
                <?php echo $person['sexo']; ?>
            </td>
            <td>
                <?php echo $person['direccion']; ?>
            </td>
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
            <td>
                <a href="?controller=persona&amp;action=edit_person&amp;id=<?php echo $person['id']; ?>">Editar</a>
                <a href="#" onclick="confirmDelete(<?php echo $person['id']; ?>)">Eliminar</a>
                <?php
                $salaryController = new SalaryController();
                $salary = $salaryController->getSalarioById($person['id']);
                if ($salary) {
                    // Si ya existe un salario, mostrar enlace para editarlo
                    ?>
                    <a href="?controller=salario&amp;action=edit_salary&amp;id=<?php echo $person['id']; ?>">Editar Salario</a>
                    <?php
                } else {
                    // Si no hay salario, mostrar enlace para agregarlo
                    ?>
                    <a href="?controller=salario&amp;action=add_salary&amp;id=<?php echo $person['id']; ?>">Agregar Salario</a>
                    <?php
                }
                ?>
            </td>
        </tr>
    <?php } ?>
</table>

<a href="?controller=administrador" style="text-decoration: none;">
    <button style="padding: 10px 20px;">Volver</button>
</a>

<script>
    function confirmDelete(id) {
        var result = confirm("¿Estás seguro de que deseas eliminar esta persona?");
        if (result) {
            window.location.href = "?controller=persona&action=delete_person&id=" + id;
        }
    }
</script>