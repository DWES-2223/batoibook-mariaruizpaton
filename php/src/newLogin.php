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
        header('Location: index.php');
    } else {
        echo 'Contraseña o usuario incorrecto';
        include './views/user/login.php';
    }

}
include './views/user/login.php';