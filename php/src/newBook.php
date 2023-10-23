<?php
include 'autoload.php';
include './myHelpers/utils.php';
use BatBook\Module;

$modulos = [];
$stats = ['Nuevo', 'Bueno', 'Usado', 'Malo', 'Digital'];
$errores = [];
try {
    $modulos = Module::loadModulesFromFile("./files/modulesbook.csv");
} catch (Exception $e){
    echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $module = $_POST['module'];
    $publisher = trim($_POST['publisher']);
    $preu = trim($_POST['price']);
    $pagines = trim($_POST['pages']);
    $status = $_POST['status'];
    $comments = trim($_POST['comments']??'');

    if (!in_array($module, $modulos)){
        $errores['module'] = 'Debe elegir un modulo válido';
    }
    if (empty($publisher)){
        $errores['publisher'] = "Editorial es requerido";
    }
    if (!is_numeric($preu)){
        $errores['price'] = "El precio tiene que ser un número";
    }
    if (!is_numeric($pagines)){
        $errores['pages'] = "Las páginas tienen que ser un número";
    }
    if (!in_array($status,$stats)){
        $errores['status'] = "Debe elegír un estado válido";
    }

    try {
        if (count($errores)){
            throw new Exception("Hay errores");
        }
    } catch (Exception $e){
        echo $e->getMessage();
        include './views/books/new.php';
        exit();
    }

    echo 'Modulo: ' . $module . '</br>';
    echo 'Editorial: ' . $publisher . '</br>';
    echo 'Precio: ' . $preu . '</br>';
    echo 'Págines: ' . $pagines . '</br>';
    echo 'Estado: ' . $status . '</br>';
    echo 'Comentario: ' . $comments . '</br>';

} else {
    include_once './views/books/new.php';
}