<?php
if (isset($_SESSION['usuario'])) {
    echo '<li>Bienvenido, ' . $_SESSION['usuario'] . '</li>';
    echo '<li><a href="newBook.php">Añadir Libro</a></li>';
    echo '<li><a href="logout.php">Logout</a></li>';
} else {
    echo '<li><a href="newLogin.php">Login</a></li>';
    echo '<li><a href="newRegister.php">Register</a></li>';
}


