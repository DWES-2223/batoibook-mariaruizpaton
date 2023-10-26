<?php
include 'load.php';
if (!isset($_SESSION)) {
    $nick = $_SESSION['usuario'];
    echo "Bienvenido " . $nick;
}
include 'header.php';
