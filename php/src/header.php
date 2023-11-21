<?php
if (isset($_SESSION['usuario'])) {
    echo 'Bienvenido/a, ' . $_SESSION['usuario']->getNick();
    echo '<li><a href="newBook.php">Añadir Libro</a></li>';
    echo '<li><a href="myBooks.php">Mis Libros</a></li>';
    if (isAdmin($_SESSION['usuario']->getId())){
        echo '<li><a href="course.view.php">Cursos</a></li>';
    }
    echo '<li><a href="logout.php">Logout</a></li>';
} else {
    if (!isset($_SESSION['visita'])){
        echo 'Bienvenido/a por primera vez';
        $_SESSION['visita'] = date('Y-m-d H:i:s');
    } else {
        echo 'Bienvenido/a, la ultima visita fue ' . $_SESSION['visita'];
        $_SESSION['visita'] = date('Y-m-d H:i:s');
    }
    echo '<li><a href="newLogin.php">Login</a></li>';
    echo '<li><a href="newRegister.php">Register</a></li>';
    echo '<li><a href="./examen/ejercicio2.php">Matriz</a></li>';
}