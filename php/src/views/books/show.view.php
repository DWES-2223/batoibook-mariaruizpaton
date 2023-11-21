<!DOCTYPE html>
<html lang="es">
<?php
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}
?>
<head>
    <title>Vista libro</title>
</head>
<body>
<form action="showBook.php" method="get">
    <h1>Libro: <?= $course->getModule($course->getIdModule()) ?></h1>
    <a href="myBooks.php">Volver a la página anterior</a>
    <table>
        <tr>
            <th>Id libro</th>
            <th>Usuario</th>
            <th>Modulo</th>
            <th>Editorial</th>
            <th>Precio</th>
            <th>Páginas</th>
            <th>Estado</th>
            <th>Comentarios</th>
            <th>Fecha venta</th>
        </tr>
        <tr>
            <td> <?= $course->getId() ?></td>
            <td> <?= $_SESSION['usuario']->getNick() ?></td>
            <td> <?= $course->getIdModule() ?></td>
            <td> <?= $course->getPublisher() ?></td>
            <td> <?= $course->getPrice() ?> €</td>
            <td> <?= $course->getPages() ?></td>
            <td> <?= $course->getStatus() ?></td>
            <td> <?= $course->getComments() ?></td>
            <td> <?= $course->getSoldDate() ?? 'En venta' ?></td>
        </tr>
    </table>
</form>
</body>
</html>


