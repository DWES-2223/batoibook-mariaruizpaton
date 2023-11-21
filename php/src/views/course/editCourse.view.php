<!DOCTYPE html>
<html lang="es">
<?php
if (!isset($_SESSION['usuario']) && !isAdmin($_SESSION['usuario']->getId())) {
    header('Location: index.php');
    exit();
}
?>
<head>
    <title>Editar libro</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<form action="updateCourse.php" method="post" enctype="multipart/form-data">
    <h1>Cycle: <?= $course->getCycle() ?></h1>
    <a href="course.view.php">Volver a la página anterior</a>
    <div>
        <label for="id">Id:</label>
        <input type="number" id="id" name="id" value="<?=$course->getId()?>" readonly>
    </div>
    <div>
        <label for="cycle">Cycle:</label>
        <input type="text" id="cycle" name="cycle" value="<?=$course->getCycle()?>" required>
        <span class="error"><?=printError($errores, 'cycle')?></span>
    </div>
    <div>
        <label for="idfamily">Id Familia:</label>
        <input type="text" id="idfamily" name="idfamily" value="<?=$course->getIdFamily()?>" readonly>
    </div>
    <div>
        <label for="vliteral">Vliteral:</label>
        <input type="text" id="vliteral" name="vliteral" value="<?=$course->getVliteral()?>" required>
        <span class="error"><?=printError($errores, 'vliteral')?></span>
    </div>
    <div>
        <label for="cliteral">Cliteral:</label>
        <input type="text" id="cliteral" name="cliteral" value="<?=$course->getCliteral()?>" required>
        <span class="error"><?=printError($errores, 'cliteral')?></span>
    </div>
    <div>
        <button type="submit" name="subir" value="subir">Editar</button>
    </div>
</form>
</body>
</html>