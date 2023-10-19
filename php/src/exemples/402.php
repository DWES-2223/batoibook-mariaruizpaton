<?php
$hobbies = ["Correr", "MTB", "Triatlon", "Sofa", "Chat GPT"];
$menu = ["Borreta", "Pericana", "Bajoques Farcides", "Arròs al forn", "Paella", "Migas", "Gaspatxo"];
$errores = [];

function printError($error, $field): string
{
    if (isset($error[$field])) {
        return '<span class="error">' . $error[$field] . '</span>';
    }
    return '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = ucfirst(trim($_POST['nom']));
    $cognoms = ucfirst(trim($_POST['cognoms']));
    $email = trim($_POST['email']);
    $url = trim($_POST['url']);
    $sexe = $_POST['sexe'];
    $aficions = $_POST['aficions'];
    $menus = $_POST['menus'];

    if (empty($nom)) {
        $errores ['nom'] = 'Nom és requerit';
    }
    if (empty($cognoms)) {
        $errores ['cognoms'] = 'Els cognoms son requerits';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores ['email'] = 'El email es invalido';
    }

    try {
        if (count($errores)) {
            throw new Exception("Hi ha errors");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        include_once '402.view.php';
        exit();
    }

    echo $nom . '<br/>';
    echo $cognoms . '<br/>';
    echo $email . '<br/>';
    echo $url . '<br/>';
    echo $sexe . '<br/>';
    foreach ($aficions as $item) {
        echo $hobbies[$item] . '<br/>';
    }

} else {
    include_once "402.view.php";
}