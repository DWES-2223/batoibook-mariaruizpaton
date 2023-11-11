<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/myHelpers/utils.php';

use BatBook\QueryBuilder;
use BatBook\User;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = QueryBuilder::sql(User::class, ['email' => $email], 1);

    if ($user) {
        if (password_verify($password, $user[0]->getPassword())) {
            echo $user[0]->toJson();
        } else {
            echo json_encode(['error' => 'Credenciales incorrectas']);
        }
    } else {
        echo json_encode(['error' => 'Usuario no encontrado']);
    }
}