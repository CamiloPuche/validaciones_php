<?php

require_once 'C:\xampp\htdocs\validaciones_php\Controller\personController.php';

$personController = new PersonController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $direccion = $_POST['direccion'];

    $personController->updatePerson($id, $nombre, $edad, $sexo, $direccion);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $person = $personController->getPersonById($id);
} else {
    header('Location: admin_person_view.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Persona</title>
</head>

<body>
    <h2>Editar Persona</h2>

    <form method="POST" action="?controller=persona&amp;action=update_person&amp;id=<?php echo $person['id']; ?>">
        <input type="hidden" name="id" value="<?php echo $person['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $person['nombre']; ?>" required><br><br>
        <label for="edad">Edad:</label>
        <input type="number" name="edad" value="<?php echo $person['edad']; ?>" required><br><br>
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select><br><br>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="<?php echo $person['direccion']; ?>" required><br><br>
        <input type="submit" name="update_person" value="Actualizar">
    </form>
</body>

</html>