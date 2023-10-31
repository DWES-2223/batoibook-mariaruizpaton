<?php
include_once 'load.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    foreach ($users as $item){

        if ($item->getEmail() == $email && password_verify($password, $item->getPassword())){
            $_SESSION['usuario'] = $item->getNick();
            header('Location: index.php');
        } else {
            $error = 'Contraseña incorrecta';
            include './views/user/login.php';
        }
    }
}
include './views/user/login.php';