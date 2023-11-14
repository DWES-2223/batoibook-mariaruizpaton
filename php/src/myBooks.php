<?php
include 'load.php';
use BatBook\Book;
if (isset($_SESSION['usuario'])) {
    $books = Book::findByUserId($_SESSION['usuario']->getId()); ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Mis Libros</title>
        </head>
        <body>
        <h1>Mis Libros</h1>
        <a href="index.php">Volver a la página de inicio</a>
        <?php if (count($books) >= 1){ ?>
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
            <th>Acciones</th>
        </tr>
        <?php
        foreach ($books as $libro){
            echo "<tr>";
            echo "<td>" . $libro->getId() . "</td>";
            echo "<td>" . $_SESSION['usuario']->getNick() . "</td>";
            echo "<td>" . $libro->getModule($libro->getIdModule()) . "</td>";
            echo "<td>" . $libro->getPublisher() . "</td>";
            echo "<td>" . $libro->getPrice() . "€ </td>";
            echo "<td>" . $libro->getPages() . "</td>";
            echo "<td>" . $libro->getStatus() . "</td>";
            echo "<td>" . $libro->getComments() . "</td>";
            echo "<td>
                    <a href='showBook.php?id=" . $libro->getId() . "'>Ver</a>
                    <a href='editBook.php?id=" . $libro->getId() . "'>Modificar</a>
                    <a href='deleteBook.php?id=" . $libro->getId() . "'>Eliminar</a>
                    <a href='printBook.php?id=" . $libro->getId() . "'>Print</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<p> No hay libros disponibles </p>";
    }?>
</table>
</body>
    </html>

<?php } else {
    header("Location: index.php");
    exit();
} ?>
