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
    <h1>Libro: <?= $book->getModule($book->getIdModule()) ?></h1>
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
            <td> <?= $book->getId() ?></td>
            <td> <?= $_SESSION['usuario']->getNick() ?></td>
            <td> <?= $book->getIdModule() ?></td>
            <td> <?= $book->getPublisher() ?></td>
            <td> <?= $book->getPrice() ?> €</td>
            <td> <?= $book->getPages() ?></td>
            <td> <?= $book->getStatus() ?></td>
            <td> <?= $book->getComments() ?></td>
            <td> <?= $book->getSoldDate() ?? 'En venta' ?></td>
        </tr>
    </table>
</form>
</body>
</html>


