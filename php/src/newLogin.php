<?php
include_once 'load.php';
use BatBook\User;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $passwordHas = password_hash($password, PASSWORD_DEFAULT);
    $user = User::login($email, $password);
    if ($user) {
        $_SESSION['usuario'] = $user;
        $_SESSION['visita' . $_SESSION['usuario']]++;
        header('Location: index.php');
    } else {
        echo 'Contraseña o usuario incorrecto';
        include_once './views/user/login.php';
    }
} else {
    include_once './views/user/login.php';
}
