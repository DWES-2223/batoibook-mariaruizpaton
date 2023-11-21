<?php

use BatBook\Course;

include 'load.php';

if (isset($_SESSION['usuario']) && isAdmin($_SESSION['usuario']->getId())) {
   $courses = Course::find() ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Mis Libros</title>
    </head>
    <body>
    <h1>Mis Libros</h1>
    <a href="index.php">Volver a la página de inicio</a>
    <table>
        <tr>
            <th>Id</th>
            <th>Modulo</th>
            <th>Vliteral</th>
            <th>Cliteral</th>
            <th>Acciones</th>
        </tr>
        <?php
        foreach ($courses as $item) {
            echo "<tr>";
            echo "<td>" . $item->getId() . "</td>";
            echo "<td>" . $item->getCycle() . "</td>";
            echo "<td>" . $item->getVliteral() . "</td>";
            echo "<td>" . $item->getCliteral() . "</td>";
            echo "<td>
                    <a href='showCourse.php?id=" . $item->getId() . "'>Ver</a>
                    <a href='editCourse.php?id=" . $item->getId() . "'>Modificar</a>
                    <a href='deleteCourse.php?id=" . $item->getId() . "'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    </body>
    </html>
<?php } else {
    header("Location: index.php");
    exit();
} ?>