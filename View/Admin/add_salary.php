<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'Administrador') {
    header('Location: View\login\login.php');
}

require_once 'C:\xampp\htdocs\validaciones_php\Controller\personController.php';

$personController = new PersonController();
$id = isset($_GET['id']) ? $_GET['id'] : null;
$person = $personController->getPersonById($id);
?>
<h3>Agregar Salario</h3>
<form method="POST" action="?controller=salario&amp;action=add_salary">
    <?php if ($person) { ?>
        <input type="hidden" name="id" value="<?php echo $person['id']; ?>">
        <p>Persona: <?php echo $person['nombre']; ?></p>
    <?php } else { ?>
        <label for="id">ID de la Persona:</label>
        <select name="id" id="id">
        <?php
        require_once 'Controller\personController.php';
        $personController = new PersonController();
        $persons = $personController->getAllPersons();

        foreach ($persons as $person) {
            echo '<option value="' . $person['id'] . '">' . $person['nombre'] . '</option>';
        }
        ?>
    </select>
    <?php } ?>
    <label for="nhoras">Número de Horas:</label>
    <input type="number" name="nhoras" id="nhoras" required>

    <label for="vhoras">Valor de Horas:</label>
    <input type="number" name="vhoras" id="vhoras" required>
    <button type="submit" name="add_salary">Agregar Salario</button>
</form>

<a href="index.php?controller=administrador" style="text-decoration: none;">
    <button style="padding: 10px 20px;">Volver</button>
</a>
