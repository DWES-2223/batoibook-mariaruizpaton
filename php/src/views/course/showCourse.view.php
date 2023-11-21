<!DOCTYPE html>
<html lang="es">
<?php
if (!isset($_SESSION['usuario']) && !isAdmin($_SESSION['usuario']->getId())) {
    header('Location: index.php');
    exit();
}
?>
<head>
    <title>Vista libro</title>
</head>
<body>
<form action="showCourse.php" method="get">
    <h1>Ciclo: <?= $course->getCycle() ?></h1>
    <a href="course.view.php">Volver a la página anterior</a>
    <table>
        <tr>
            <th>Id</th>
            <th>Cycle</th>
            <th>Familia</th>
            <th>Vliteral</th>
            <th>Cliteral</th>
        <tr>
            <td> <?= $course->getId() ?></td>
            <td> <?= $course->getCycle() ?></td>
            <td> <?= $course->getFamilyString($course->getIdFamily()) ?></td>
            <td> <?= $course->getVliteral() ?> €</td>
            <td> <?= $course->getCliteral() ?></td>
        </tr>
    </table>
</form>
</body>
</html>

