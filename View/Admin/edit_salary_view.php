<h2>Editar Salario</h2>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $salario['id']; ?>">

    <label for="nhoras">Número de Horas:</label>
    <input type="number" name="nhoras" id="nhoras" value="<?php echo $salario['nhoras']; ?>">

    <label for="vhoras">Valor de Horas:</label>
    <input type="number" name="vhoras" id="vhoras" value="<?php echo $salario['vhoras']; ?>">

    <input type="submit" value="Guardar">
</form>