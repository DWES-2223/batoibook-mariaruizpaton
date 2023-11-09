<?php
use BatBook\User;
include_once 'load.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nick = trim($_POST['nick']);
    $email = trim(($_POST['email']));
    $password = $_POST['password'];
    $password2 = $_POST['confirm_password'];

    if (empty($nick) || empty($email) || empty($password) || empty($password2)){
        $error = 'Debes introducir un usuario y contraseña';
        include './views/user/register.php';
    } else {
        if ($password !== $password2){
            $error = 'No coincidenn las contraseñas';
            include './views/user/register.php';
        } else {
            $user = null;
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            try {
                $user = new User($email, $passwordHash, $nick);
                $userId = $user->save();
                $_SESSION['usuario'] = $user;
                header('Location: index.php');
            } catch (\BatBook\Exempcions\WeekPasswordException $e) {
                echo $e->getMessage();
            }
        }
    }
}
include './views/user/register.php';